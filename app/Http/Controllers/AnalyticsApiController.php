<?php

namespace App\Http\Controllers;

use App\Models\AnalyticsEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnalyticsApiController extends Controller
{
    protected array $botPatterns = [
        'bot', 'crawl', 'spider', 'slurp', 'mediapartners', 'ahrefs', 'semrush',
        'dotbot', 'mj12bot', 'bytespider', 'petalbot', 'amazonbot', 'applebot',
        'facebookexternalhit', 'meta-externalagent', 'bingbot', 'googlebot',
        'yandex', 'duckduckbot', 'baiduspider', 'twitterbot', 'linkedinbot',
        'whatsapp', 'telegrambot', 'discordbot', 'curl', 'wget', 'python',
        'httpclient', 'postman', 'headless', 'lighthouse'
    ];

    public function track(Request $request): JsonResponse
    {
        $userAgent = $request->userAgent() ?? '';
        if (empty($userAgent)) {
            return response()->json(['status' => 'ignored_bot'], 200);
        }

        $regex = '/' . implode('|', $this->botPatterns) . '/i';
        if (preg_match($regex, $userAgent)) {
            return response()->json(['status' => 'ignored_bot'], 200);
        }

        $eventType = substr(trim($request->input('event', $request->input('event_name', 'unknown'))), 0, 50);
        $eventLabel = substr(trim($request->input('label', $request->input('event_label', ''))), 0, 100);

        if (empty($eventType) || $eventType === 'unknown') {
            return response()->json(['status' => 'invalid_event'], 400);
        }

        $ip = $request->ip() ?? '127.0.0.1';
        $ipHash = hash('sha256', $ip . 'quienllama_cl_salt_2026');

        AnalyticsEvent::create([
            'event_type' => $eventType,
            'event_label' => $eventLabel,
            'ip_hash' => $ipHash,
        ]);

        return response()->json(['status' => 'ok'], 200);
    }
}
