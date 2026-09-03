<?php

namespace App\Http\Controllers;

use App\Models\AnalyticsEvent;
use App\Models\Phone;
use App\Models\Search;
use App\Services\MexicoPhoneHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function search(Request $request): RedirectResponse|View
    {
        $q = trim($request->input('q', ''));

        if (empty($q)) {
            return redirect()->route('home');
        }

        // Registrar evento de búsqueda
        AnalyticsEvent::create([
            'event_type' => 'search_query',
            'event_label' => substr($q, 0, 50),
            'ip_hash' => hash('sha256', $request->ip() . 'salt2026'),
        ]);

        $normalized = MexicoPhoneHelper::normalize($q);

        if ($normalized) {
            $isNew = !Phone::where('number', $normalized)->exists();

            if ($isNew) {
                $ladaInfo = MexicoPhoneHelper::getLadaInfo($normalized);
                Phone::create([
                    'number' => $normalized,
                    'area_code' => $ladaInfo['code'],
                    'location' => $ladaInfo['location'],
                    'spam_score' => 0,
                    'views' => 1,
                ]);
            }

            // Registrar en historial de búsquedas
            Search::create([
                'number' => $normalized,
                'is_new' => $isNew,
                'ip_hash' => hash('sha256', $request->ip() . 'salt2026'),
            ]);

            return redirect()->route('phone.show', ['number' => $normalized]);
        }

        // Búsqueda por coincidencia parcial o código de área
        $cleanDigits = preg_replace('/\D/', '', $q);
        $phones = Phone::where('number', 'like', "%{$cleanDigits}%")
            ->orWhere('location', 'like', "%{$q}%")
            ->orderByDesc('views')
            ->paginate(20);

        return view('search.results', compact('q', 'phones'));
    }
}
