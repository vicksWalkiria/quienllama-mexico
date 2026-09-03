<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Services\AreaCodeService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $xml = Cache::remember('sitemap_xml', 3600, function () {
            $phones = Phone::select('number', 'updated_at')->orderByDesc('updated_at')->get();
            $areaCodes = array_keys(AreaCodeService::getAll());

            $staticRoutes = [
                ['url' => route('home'), 'priority' => '1.0', 'changefreq' => 'daily', 'lastmod' => now()->toAtomString()],
                ['url' => route('area-codes.index'), 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => now()->toAtomString()],
                ['url' => route('vcf.index'), 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => now()->toAtomString()],
                ['url' => route('legal.no-molestar'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => now()->toAtomString()],
                ['url' => route('legal.about'), 'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => now()->toAtomString()],
                ['url' => route('contact.index'), 'priority' => '0.5', 'changefreq' => 'monthly', 'lastmod' => now()->toAtomString()],
            ];

            $out = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $out .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

            // Static Pages
            foreach ($staticRoutes as $page) {
                $out .= "  <url>\n";
                $out .= "    <loc>{$page['url']}</loc>\n";
                $out .= "    <lastmod>{$page['lastmod']}</lastmod>\n";
                $out .= "    <changefreq>{$page['changefreq']}</changefreq>\n";
                $out .= "    <priority>{$page['priority']}</priority>\n";
                $out .= "  </url>\n";
            }

            // Area Codes
            foreach ($areaCodes as $code) {
                $loc = route('area-codes.show', $code);
                $now = now()->toAtomString();
                $out .= "  <url>\n";
                $out .= "    <loc>{$loc}</loc>\n";
                $out .= "    <lastmod>{$now}</lastmod>\n";
                $out .= "    <changefreq>weekly</changefreq>\n";
                $out .= "    <priority>0.8</priority>\n";
                $out .= "  </url>\n";
            }

            // Phones
            foreach ($phones as $phone) {
                $loc = route('phone.show', $phone->number);
                $mod = $phone->updated_at ? $phone->updated_at->toAtomString() : now()->toAtomString();
                $out .= "  <url>\n";
                $out .= "    <loc>{$loc}</loc>\n";
                $out .= "    <lastmod>{$mod}</lastmod>\n";
                $out .= "    <changefreq>weekly</changefreq>\n";
                $out .= "    <priority>0.7</priority>\n";
                $out .= "  </url>\n";
            }

            $out .= '</urlset>';

            return $out;
        });

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }
}
