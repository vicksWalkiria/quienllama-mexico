<?php

namespace App\Console\Commands;

use App\Models\Phone;
use App\Services\AreaCodeService;
use App\Services\IndexNowService;
use Illuminate\Console\Command;

class IndexNowPingCommand extends Command
{
    protected $signature = 'indexnow:ping {--all : Ping all URLs including all phones and area codes}';
    protected $description = 'Submit URLs to IndexNow (Bing, Yandex, etc.) for instant indexing';

    public function handle(): int
    {
        $this->info('Gathering URLs for IndexNow ping...');

        $urls = [
            route('home'),
            route('area-codes.index'),
            route('vcf.index'),
            route('legal.no-molestar'),
            route('legal.about'),
            route('contact.index'),
        ];

        // Códigos de área
        foreach (array_keys(AreaCodeService::getAll()) as $code) {
            $urls[] = route('area-codes.show', $code);
        }

        // Teléfonos
        $phoneLimit = $this->option('all') ? 1000 : 100;
        $phones = Phone::orderByDesc('updated_at')->limit($phoneLimit)->pluck('number');
        foreach ($phones as $number) {
            $urls[] = route('phone.show', $number);
        }

        $this->info("Submitting " . count($urls) . " URLs to IndexNow...");
        $res = IndexNowService::submitUrls($urls);

        if ($res) {
            $this->info("✅ Successfully submitted " . count($urls) . " URLs to IndexNow!");
            return Command::SUCCESS;
        }

        $this->warn("⚠️ IndexNow endpoint returned non-200, check logs.");
        return Command::SUCCESS;
    }
}
