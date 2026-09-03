<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IndexNowService
{
    const KEY = '6056f71057e94e9f90cf92f349377488';
    const HOST = 'mx.quienllama.com.es';

    /**
     * Submit a single URL or list of URLs to IndexNow (Bing, Yandex, etc.)
     */
    public static function submitUrls(array|string $urls): bool
    {
        if (!is_array($urls)) {
            $urls = [$urls];
        }

        $urlList = array_values(array_unique(array_filter($urls)));
        if (empty($urlList)) {
            return false;
        }

        // Asegurar que todas las URLs correspondan estrictamente a https://ar.quienllama.com.es/
        $normalizedUrls = array_map(function ($url) {
            $parsed = parse_url($url);
            $path = $parsed['path'] ?? '/';
            if (!str_starts_with($path, '/')) {
                $path = '/' . $path;
            }
            if (isset($parsed['query'])) {
                $path .= '?' . $parsed['query'];
            }
            return 'https://' . self::HOST . $path;
        }, $urlList);

        $payload = [
            'host' => self::HOST,
            'key' => self::KEY,
            'keyLocation' => 'https://' . self::HOST . '/' . self::KEY . '.txt',
            'urlList' => array_values(array_unique($normalizedUrls)),
        ];

        $endpoints = [
            'https://api.indexnow.org/indexnow',
            'https://www.bing.com/indexnow',
        ];

        $success = false;
        foreach ($endpoints as $endpoint) {
            try {
                $response = Http::timeout(15)->asJson()->post($endpoint, $payload);
                if ($response->successful() || in_array($response->status(), [200, 202])) {
                    $success = true;
                } else {
                    Log::warning("IndexNow response {$response->status()} from {$endpoint}: " . $response->body());
                }
            } catch (\Exception $e) {
                Log::warning("IndexNow error for {$endpoint}: " . $e->getMessage());
            }
        }

        return $success;
    }
}
