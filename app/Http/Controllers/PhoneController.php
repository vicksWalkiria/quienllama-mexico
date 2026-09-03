<?php

namespace App\Http\Controllers;

use App\Models\AnalyticsEvent;
use App\Models\Comment;
use App\Models\Phone;
use App\Services\MexicoPhoneHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PhoneController extends Controller
{
    public function show(string $number): View|RedirectResponse
    {
        // Normalizar entrada a 10 dígitos canónicos IFT
        $clean = MexicoPhoneHelper::normalize($number);

        if (!$clean) {
            return redirect()->route('home')->with('error', 'El número ingresado no corresponde a un formato válido de teléfono en México (10 dígitos).');
        }

        // Si la URL llamada no coincide exactamente con el formato canónico, redirigir 301
        if ($number !== $clean) {
            return redirect()->route('phone.show', ['number' => $clean], 301);
        }

        $phone = Phone::where('number', $clean)->first();

        // Si no existe, crearlo al vuelo
        if (!$phone) {
            $ladaInfo = MexicoPhoneHelper::getLadaInfo($clean);
            $phone = Phone::create([
                'number' => $clean,
                'area_code' => $ladaInfo['code'],
                'location' => $ladaInfo['location'],
                'spam_score' => 0,
                'views' => 1,
            ]);
        } else {
            $phone->increment('views');
        }

        // Registro de telemetría de visita
        AnalyticsEvent::create([
            'event_type' => 'view_phone',
            'event_label' => $clean,
            'ip_hash' => hash('sha256', request()->ip() . 'salt2026'),
        ]);

        $comments = $phone->comments()->paginate(15);
        $risk = $phone->getRiskLevel();
        $dialing = $phone->details();
        $formatted = $phone->formatted();

        // Estadísticas de motivos de llamada
        $reasonCounts = Comment::where('phone_id', $phone->id)
            ->selectRaw('reason, count(*) as total')
            ->groupBy('reason')
            ->pluck('total', 'reason')
            ->toArray();

        // Números relacionados de la misma clave LADA
        $relatedPhones = Phone::where('area_code', $phone->area_code)
            ->where('id', '!=', $phone->id)
            ->orderByDesc('views')
            ->limit(6)
            ->get();

        return view('phone.show', compact(
            'phone',
            'comments',
            'risk',
            'dialing',
            'formatted',
            'reasonCounts',
            'relatedPhones'
        ));
    }

    public function storeComment(Request $request, string $number): RedirectResponse
    {
        // Honeypot anti-bot check
        if (!empty($request->input('website_hp'))) {
            return back()->with('success', '¡Gracias! Tu reporte fue registrado y ayudará a millones de usuarios en México a prevenir extorsiones y llamadas molestas.');
        }

        $clean = MexicoPhoneHelper::normalize($number);
        if (!$clean) {
            return back()->with('error', 'Número de teléfono inválido.');
        }

        $request->validate([
            'content' => 'required|string|min:6|max:1000',
            'reason' => 'required|string|max:100',
            'author_name' => 'nullable|string|max:60',
        ]);

        $phone = Phone::where('number', $clean)->firstOrFail();

        $comment = Comment::create([
            'phone_id' => $phone->id,
            'author_name' => $request->author_name ?: 'Anónimo',
            'content' => strip_tags($request->content),
            'reason' => $request->reason,
            'ip_hash' => hash('sha256', $request->ip() . 'salt2026'),
        ]);

        // Aumentar spam_score según la gravedad del motivo en México
        $increment = match ($request->reason) {
            'Extorsión / Secuestro Virtual' => 25,
            'Fraude Bancario / Phishing' => 20,
            'Cobranza Abusiva' => 15,
            'Telemarketing / Ventas' => 10,
            'Llamada Fantasma / Silenciosa' => 8,
            default => 5,
        };
        $phone->spam_score = min(100, $phone->spam_score + $increment);
        $phone->touch();
        $phone->save();

        // Enviar alerta por email al administrador con la puntuación actualizada
        \App\Services\NotificationService::sendSpamReportAlert($phone, $comment, $request);

        // Notificar a IndexNow en tiempo real para acelerar indexación en buscadores
        try {
            \App\Services\IndexNowService::submitUrls([route('phone.show', $phone->number)]);
        } catch (\Throwable $e) {
            // Non-blocking
        }

        AnalyticsEvent::create([
            'event_type' => 'report_spam_phone',
            'event_label' => $clean,
            'ip_hash' => hash('sha256', $request->ip() . 'salt2026'),
        ]);

        return back()->with('success', '¡Gracias! Tu reporte fue registrado y ayudará a millones de usuarios en México a prevenir extorsiones y llamadas molestas.');
    }

    public function voteReason(Request $request, string $number): RedirectResponse
    {
        $clean = MexicoPhoneHelper::normalize($number);
        if (!$clean) {
            return back();
        }

        $request->validate(['reason' => 'required|string|max:100']);
        $phone = Phone::where('number', $clean)->firstOrFail();

        Comment::create([
            'phone_id' => $phone->id,
            'author_name' => 'Votante anónimo',
            'content' => 'Reportado como: ' . $request->reason,
            'reason' => $request->reason,
            'ip_hash' => hash('sha256', $request->ip() . 'salt2026'),
        ]);

        $phone->increment('spam_score', 5);

        AnalyticsEvent::create([
            'event_type' => 'select_poll_reason',
            'event_label' => $request->reason,
            'ip_hash' => hash('sha256', $request->ip() . 'salt2026'),
        ]);

        return back()->with('success', 'Tu voto ha sido sumado a las estadísticas del número.');
    }

    public function downloadVcf(string $number): Response
    {
        $clean = MexicoPhoneHelper::normalize($number);
        $formatted = MexicoPhoneHelper::format($clean ?? $number);

        $vcard = "BEGIN:VCARD\r\n";
        $vcard .= "VERSION:3.0\r\n";
        $vcard .= "FN:SPAM {$formatted} (Bloquear)\r\n";
        $vcard .= "N:;SPAM {$formatted} (Bloquear);;;\r\n";
        $vcard .= "TEL;TYPE=CELL,VOICE:+52{$clean}\r\n";
        $vcard .= "NOTE:Reportado como llamada molesta o sospechosa en mx.quienllama.com.es\r\n";
        $vcard .= "END:VCARD\r\n";

        AnalyticsEvent::create([
            'event_type' => 'download_vcf_single',
            'event_label' => $clean,
            'ip_hash' => hash('sha256', request()->ip() . 'salt2026'),
        ]);

        return response($vcard, 200, [
            'Content-Type' => 'text/vcard; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"bloquear_{$clean}.vcf\"",
        ]);
    }
}
