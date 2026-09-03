<?php

namespace App\Http\Controllers;

use App\Models\AnalyticsEvent;
use App\Models\Phone;
use App\Services\AreaCodeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AreaCodeController extends Controller
{
    public function index(Request $request): View
    {
        $grouped = AreaCodeService::getGroupedByRegion();
        $topCodes = AreaCodeService::getTopPopular(16);
        $totalCodes = count(AreaCodeService::getAll());

        AnalyticsEvent::create([
            'event_type' => 'view_area_codes_index',
            'ip_hash' => hash('sha256', $request->ip() . 'salt2026'),
        ]);

        return view('area_codes.index', compact('grouped', 'topCodes', 'totalCodes'));
    }

    public function show(string $code): View|RedirectResponse
    {
        $clean = ltrim(preg_replace('/\D/', '', $code), '0');

        // Redirigir si vinieron con 0 inicial
        if ($code !== $clean && !empty($clean)) {
            return redirect()->route('area-codes.show', ['code' => $clean], 301);
        }

        $info = AreaCodeService::find($clean);

        if (!$info) {
            return redirect()->route('area-codes.index')
                ->with('error', "No se encontró información para la clave LADA {$code} en México.");
        }

        // Obtener teléfonos investigados en este código de área
        $phones = Phone::where('area_code', $clean)
            ->orderByDesc('views')
            ->limit(12)
            ->get();

        // Códigos hermanos de la misma región
        $regionCodes = AreaCodeService::getGroupedByRegion()[$info['region']] ?? [];

        AnalyticsEvent::create([
            'event_type' => 'view_area_code_detail',
            'event_label' => $clean,
            'ip_hash' => hash('sha256', request()->ip() . 'salt2026'),
        ]);

        return view('area_codes.show', compact('info', 'clean', 'phones', 'regionCodes'));
    }
}
