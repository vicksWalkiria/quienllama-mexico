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

        // Últimos números con actividad / reportes
        $recentPhones = Phone::withCount('comments')
            ->latest('updated_at')
            ->limit(10)
            ->get();

        // Últimos comentarios ciudadanos
        $recentComments = Comment::with('phone')
            ->latest()
            ->limit(8)
            ->get();

        // Números para la cuadrícula de pastillas (pills)
        $pillsPhones = Phone::orderByDesc('views')
            ->limit(32)
            ->get();

        return view('home', compact(
            'totalPhones',
            'totalComments',
            'totalSearches',
            'topSpamPhones',
            'recentPhones',
            'recentComments',
            'pillsPhones'
        ));
    }
}
