<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LegalController extends Controller
{
    public function noMolestar(): View
    {
        return view('legal.no_molestar');
    }

    public function privacidad(): View
    {
        return view('legal.privacidad');
    }

    public function terminos(): View
    {
        return view('legal.terminos');
    }

    public function cookies(): View
    {
        return view('legal.cookies');
    }

    public function about(): View
    {
        return view('legal.about');
    }
}
