<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Phone;
use App\Models\Search;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $totalPhones = Phone::count();
        $totalComments = Comment::count();
        $totalSearches = Search::count();

        // Top teléfonos más buscados / denunciados
        $topSpamPhones = Phone::withCount('comments')
            ->orderByDesc('spam_score')
            ->orderByDesc('views')
            ->limit(10)
            ->get();

        // Últimos números con actividad / reportes (50 para Google y Bing)
        $recentPhones = Phone::withCount('comments')
            ->latest('updated_at')
            ->limit(50)
            ->get();

        // Últimos comentarios ciudadanos (12 opiniones)
        $recentComments = Comment::with('phone')
            ->latest()
            ->limit(12)
            ->get();

        // Números para la cuadrícula de pastillas (50 números recientes)
        $pillsPhones = Phone::latest('updated_at')
            ->limit(50)
            ->get();

        // Más teléfonos investigados (16 para cuadrícula 4x4)
        $randomPhones = Phone::inRandomOrder()
            ->limit(16)
            ->get();

        return view('home', compact(
            'totalPhones',
            'totalComments',
            'totalSearches',
            'topSpamPhones',
            'recentPhones',
            'recentComments',
            'pillsPhones',
            'randomPhones'
        ));
    }
}
