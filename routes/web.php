<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\MetricsController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VcfController;
use Illuminate\Support\Facades\Route;

// Página principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Buscador
Route::get('/buscar', [SearchController::class, 'search'])->name('search');

// Bloqueador masivo VCF
Route::get('/bloquear-spam-masivo', [VcfController::class, 'index'])->name('vcf.index');
Route::get('/vcf/descargar/{type?}', [VcfController::class, 'download'])->name('vcf.download');

// Páginas informativas y legales adaptadas a México
Route::get('/no-molestar', [LegalController::class, 'noMolestar'])->name('legal.no-molestar');
Route::get('/profeco-repep', function () { return redirect()->route('legal.no-molestar', [], 301); });
Route::get('/repep', function () { return redirect()->route('legal.no-molestar', [], 301); });
Route::get('/condusef-reus', function () { return redirect()->route('legal.no-molestar', [], 301); });
Route::get('/reus', function () { return redirect()->route('legal.no-molestar', [], 301); });
Route::get('/sernac-no-molestar', function () { return redirect()->route('legal.no-molestar', [], 301); });
Route::get('/privacidad', [LegalController::class, 'privacidad'])->name('legal.privacidad');
Route::get('/terminos', [LegalController::class, 'terminos'])->name('legal.terminos');
Route::get('/cookies', [LegalController::class, 'cookies'])->name('legal.cookies');
Route::get('/sobre-mi', [LegalController::class, 'about'])->name('legal.about');
Route::get('/sobre-nosotros', function () { return redirect()->route('legal.about'); });

// App Android Oficial Google Play
Route::get('/app', function () {
    return view('app_landing');
})->name('app.landing');
Route::get('/app-android', function () { return redirect()->route('app.landing', [], 301); });
Route::get('/descargar-app', function () { return redirect()->route('app.landing', [], 301); });

// Directorio de Claves LADA de México (IFT)
Route::get('/claves-lada', [\App\Http\Controllers\AreaCodeController::class, 'index'])->name('area-codes.index');
Route::get('/clave-lada/{code}', [\App\Http\Controllers\AreaCodeController::class, 'show'])->name('area-codes.show');
Route::get('/prefijos', function () { return redirect()->route('area-codes.index', [], 301); });
Route::get('/ladas', function () { return redirect()->route('area-codes.index', [], 301); });
Route::get('/codigos-de-area', function () { return redirect()->route('area-codes.index', [], 301); });
Route::get('/caracteristicas', function () { return redirect()->route('area-codes.index', [], 301); });
Route::get('/prefijo/{code}', function ($code) { return redirect()->route('area-codes.show', ['code' => $code], 301); });
Route::get('/lada/{code}', function ($code) { return redirect()->route('area-codes.show', ['code' => $code], 301); });
Route::get('/codigo-de-area/{code}', function ($code) { return redirect()->route('area-codes.show', ['code' => $code], 301); });

// Sitemap XML para Google
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

// API de Telemetría & Conversiones (sendBeacon / Hybrid GA4 + SQLite)
Route::post('/api/track', [\App\Http\Controllers\AnalyticsApiController::class, 'track'])->name('api.track');

// Rutas de Administración protegidas estrictamente por IP
Route::middleware('admin.ip')->group(function () {
    // API IndexNow Ping Masivo (Bing, Yandex, etc.)
    Route::get('/api/indexnow-ping-all', function (\Illuminate\Http\Request $request) {
        \Illuminate\Support\Facades\Artisan::call('indexnow:ping', ['--all' => true]);
        $output = \Illuminate\Support\Facades\Artisan::output();

        return response("<pre style='background:#0f172a; color:#38bdf8; padding:2rem; font-size:1.1rem; border-radius:12px;'>{$output}</pre>");
    })->name('api.indexnow');

    // Panel interno de métricas y telemetría
    Route::get('/panel-metricas', [MetricsController::class, 'index'])->name('metrics.index');
});

// Contacto y Soporte
Route::get('/contacto', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contacto', [\App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

// Acciones sobre números de teléfono protegidas contra bots
Route::post('/numero/{number}/comentar', [PhoneController::class, 'storeComment'])->middleware('throttle:10,1')->name('phone.comment');
Route::post('/numero/{number}/votar', [PhoneController::class, 'voteReason'])->middleware('throttle:20,1')->name('phone.vote');
Route::get('/numero/{number}/vcf', [PhoneController::class, 'downloadVcf'])->name('phone.vcf');
Route::get('/vcf/{number}.vcf', [PhoneController::class, 'downloadVcf']);
Route::get('/{number}.vcf', [PhoneController::class, 'downloadVcf']);

// ============================================================
// API v1 para la App Android Oficial (Multi-país)
// ============================================================
$validateAppApi = function(\Illuminate\Http\Request $request, string $action): bool {
    $secret = env('QUIENLLAMA_API_SECRET', 'ql_secure_sig_walkiria_2026');
    $timestamp = intval($request->header('X-App-Timestamp', 0));
    $signature = trim($request->header('X-App-Signature', ''));

    $tsSeconds = ($timestamp > 10000000000) ? intval($timestamp / 1000) : $timestamp;
    $expectedHmac = hash_hmac('sha256', "$action:$timestamp", $secret);
    $expectedSha = hash('sha256', "$action:$timestamp:$secret");

    return ($timestamp > 0 && abs(time() - $tsSeconds) < 120 && 
            (hash_equals($expectedHmac, $signature) || hash_equals($expectedSha, $signature)));
};

Route::get('/api/v1/sync', function (\Illuminate\Http\Request $request) use ($validateAppApi) {
    if (!$validateAppApi($request, 'sync')) {
        return response()->json(['status' => 'error', 'message' => 'Acceso no autorizado'], 403);
    }

    $since = intval($request->query('since', 0));
    if ($since > 10000000000) $since = intval($since / 1000);
    $sinceDate = $since > 0 ? date('Y-m-d H:i:s', $since) : '2000-01-01 00:00:00';

    $phones = \App\Models\Phone::with(['comments' => function($q) {
        $q->latest()->limit(1);
    }])->where('created_at', '>=', $sinceDate)->latest()->limit(1000)->get();

    $numbers = $phones->map(function ($p) {
        $lastComment = $p->comments->first();
        return [
            'n' => $p->number,
            's' => intval($p->spam_score ?: 80),
            'c' => $p->comments()->count(),
            't' => $lastComment ? ($lastComment->reason ?: 'Spam telefónico') : 'Llamada no deseada'
        ];
    });

    return response()->json([
        'status' => 'success',
        'server_timestamp' => time(),
        'count' => count($numbers),
        'numbers' => $numbers
    ]);
});

Route::get('/api/v1/phone/{number}', function (\Illuminate\Http\Request $request, string $number) use ($validateAppApi) {
    $cleanNumber = preg_replace('/[^0-9]/', '', $number);

    if (!$validateAppApi($request, "phone:$cleanNumber")) {
        return response()->json(['status' => 'error', 'message' => 'Acceso no autorizado'], 403);
    }

    $phone = \App\Models\Phone::where('number', $cleanNumber)->first();

    if (!$phone) {
        return response()->json(['status' => 'not_found', 'phone' => null, 'comments' => []]);
    }

    $comments = $phone->comments()->latest()->limit(20)->get()->map(function ($c) {
        return [
            'id' => $c->id,
            'author' => 'Usuario',
            'reason' => $c->reason ?: 'Spam',
            'content' => $c->content,
            'created_at' => $c->created_at ? $c->created_at->format('Y-m-d H:i:s') : 'Reciente'
        ];
    });

    return response()->json([
        'status' => 'success',
        'phone' => [
            'number' => $phone->number,
            'spam_score' => intval($phone->spam_score ?: 80),
            'reports_count' => count($comments)
        ],
        'comments' => $comments
    ]);
});

Route::post('/api/v1/report', function (\Illuminate\Http\Request $request) use ($validateAppApi) {
    if (!$validateAppApi($request, 'report')) {
        return response()->json(['status' => 'error', 'message' => 'Acceso no autorizado'], 403);
    }

    $number = preg_replace('/[^0-9]/', '', $request->input('number', ''));
    $reason = htmlspecialchars(strip_tags(trim($request->input('reason', 'Otro'))), ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars(strip_tags(trim($request->input('content', ''))), ENT_QUOTES, 'UTF-8');

    if (strlen($number) < 7 || empty($content)) {
        return response()->json(['status' => 'error', 'message' => 'Datos inválidos'], 422);
    }

    $phone = \App\Models\Phone::firstOrCreate(
        ['number' => $number],
        ['spam_score' => 85, 'views' => 1]
    );

    $phone->increment('spam_score', 5);
    $phone->comments()->create([
        'reason' => $reason,
        'content' => $content,
        'ip_hash' => hash('sha256', $request->ip() ?: '127.0.0.1')
    ]);

    return response()->json(['status' => 'success', 'message' => 'Reporte registrado']);
});

// Ficha de teléfono (admite formato directo ej: /1151010080 o /numero/1151010080)
Route::get('/numero/{number}', [PhoneController::class, 'show']);
Route::get('/{number}', [PhoneController::class, 'show'])
    ->where('number', '[0-9\+\s\-\(\)]+')
    ->name('phone.show');
