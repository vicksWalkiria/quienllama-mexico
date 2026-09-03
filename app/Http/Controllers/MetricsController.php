<?php

namespace App\Http\Controllers;

use App\Models\AnalyticsEvent;
use App\Models\Comment;
use App\Models\Phone;
use App\Models\Search;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MetricsController extends Controller
{
    public function index(Request $request): View
    {
        $allowedIpsConfig = config('app.admin_allowed_ips', env('ADMIN_ALLOWED_IPS', '81.202.45.23,127.0.0.1,::1'));
        $allowedIps = array_map('trim', explode(',', (string) $allowedIpsConfig));

        if (!in_array($request->ip(), $allowedIps, true)) {
            abort(403, 'Acceso denegado: IP no autorizada.');
        }

        $totalPhones = Phone::count();
        $totalComments = Comment::count();
        $totalSearches = Search::count();
        $newDiscoveredPhones = Search::where('is_new', true)->count();

        // Top búsquedas
        $topSearches = Search::selectRaw('number, count(*) as total, max(created_at) as last_searched')
            ->groupBy('number')
            ->orderByDesc('total')
            ->limit(30)
            ->get();

        // Búsquedas recientes
        $recentSearches = Search::latest()->limit(30)->get();

        // Resumen de eventos
        $eventsSummary = AnalyticsEvent::selectRaw('event_type, count(*) as count')
            ->groupBy('event_type')
            ->orderByDesc('count')
            ->get();

        return view('metrics.index', compact(
            'totalPhones',
            'totalComments',
            'totalSearches',
            'newDiscoveredPhones',
            'topSearches',
            'recentSearches',
            'eventsSummary'
        ));
    }
}
