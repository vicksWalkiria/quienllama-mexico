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

// Acciones sobre números de teléfono
Route::post('/numero/{number}/comentar', [PhoneController::class, 'storeComment'])->name('phone.comment');
Route::post('/numero/{number}/votar', [PhoneController::class, 'voteReason'])->name('phone.vote');
Route::get('/numero/{number}/vcf', [PhoneController::class, 'downloadVcf'])->name('phone.vcf');
Route::get('/vcf/{number}.vcf', [PhoneController::class, 'downloadVcf']);
Route::get('/{number}.vcf', [PhoneController::class, 'downloadVcf']);

// Ficha de teléfono (admite formato directo ej: /1151010080 o /numero/1151010080)
Route::get('/numero/{number}', [PhoneController::class, 'show']);
Route::get('/{number}', [PhoneController::class, 'show'])
    ->where('number', '[0-9\+\s\-\(\)]+')
    ->name('phone.show');
