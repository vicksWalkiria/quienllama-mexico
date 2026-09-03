<?php

namespace App\Http\Controllers;

use App\Models\AnalyticsEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact');
    }

    public function submit(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:120',
            'subject' => 'required|string|max:120',
            'message' => 'required|string|min:10|max:2000',
        ]);

        AnalyticsEvent::create([
            'event_type' => 'contact_submission',
            'event_label' => $request->subject,
            'ip_hash' => hash('sha256', $request->ip() . 'salt2026'),
        ]);

        \App\Services\NotificationService::sendContactMessageAlert($request);

        return back()->with('success', '¡Mensaje recibido correctamente! Nos pondremos en contacto contigo a la brevedad.');
    }
}
