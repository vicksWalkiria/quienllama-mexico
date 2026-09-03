<?php

namespace App\Http\Controllers;

use App\Models\AnalyticsEvent;
use App\Models\Phone;
use Illuminate\Http\Response;
use Illuminate\View\View;

class VcfController extends Controller
{
    public function index(): View
    {
        $topSpamCount = Phone::where('spam_score', '>', 0)->count();
        $samplePhones = Phone::orderByDesc('spam_score')->orderByDesc('views')->limit(8)->get();

        return view('vcf.index', compact('topSpamCount', 'samplePhones'));
    }

    public function download(string $type = 'top-100'): Response
    {
        $cleanType = str_replace('-', '', strtolower($type));
        $limit = match ($cleanType) {
            'top50' => 50,
            'top500' => 500,
            default => 100,
        };

        // Si la base de datos es nueva u orgánica, obtener los números más investigados
        $query = Phone::where('spam_score', '>', 0);
        if ($query->count() < 10) {
            $phones = Phone::orderByDesc('spam_score')
                ->orderByDesc('views')
                ->limit($limit)
                ->get();
        } else {
            $phones = $query->orderByDesc('spam_score')
                ->orderByDesc('views')
                ->limit($limit)
                ->get();
        }

        $vcfContent = "";
        foreach ($phones as $p) {
            $formatted = $p->formatted();
            $vcfContent .= "BEGIN:VCARD\r\n";
            $vcfContent .= "VERSION:3.0\r\n";
            $vcfContent .= "FN:SPAM {$formatted}\r\n";
            $vcfContent .= "N:;SPAM {$formatted};;;\r\n";
            $vcfContent .= "TEL;TYPE=CELL,VOICE:+52{$p->number}\r\n";
            $vcfContent .= "NOTE:Reportado como spam en QuiénLlama México (mx.quienllama.com.es)\r\n";
            $vcfContent .= "END:VCARD\r\n";
        }

        AnalyticsEvent::create([
            'event_type' => 'vcf_download_pack',
            'event_label' => $type,
            'ip_hash' => hash('sha256', request()->ip() . 'salt2026'),
        ]);

        $date = now()->format('Ymd');
        return response($vcfContent, 200, [
            'Content-Type' => 'text/vcard; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"bloquear_spam_mexico_{$type}_{$date}.vcf\"",
        ]);
    }
}
