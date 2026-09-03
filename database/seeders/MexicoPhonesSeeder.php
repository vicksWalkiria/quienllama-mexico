<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Phone;
use App\Services\MexicoPhoneHelper;
use Illuminate\Database\Seeder;

class MexicoPhonesSeeder extends Seeder
{
    public function run(): void
    {
        $realData = [
            [
                'number' => '5588982939',
                'spam_score' => 2,
                'views' => 15,
                'comments' => [
                    [
                        'author_name' => 'Usuario de CDMX',
                        'reason' => 'Fraude Bancario / Phishing',
                        'content' => 'mandan SMS indicando que estan vinculando a un modelo de telefono celular',
                        'created_at' => '2026-09-01 21:43:22',
                    ]
                ]
            ],
            [
                'number' => '3312826188',
                'spam_score' => 1,
                'views' => 6,
                'comments' => []
            ],
            [
                'number' => '3368027332',
                'spam_score' => 1,
                'views' => 5,
                'comments' => []
            ],
            [
                'number' => '3362326230',
                'spam_score' => 1,
                'views' => 4,
                'comments' => []
            ],
            [
                'number' => '8135325694',
                'spam_score' => 1,
                'views' => 8,
                'comments' => []
            ],
            [
                'number' => '3361799253',
                'spam_score' => 1,
                'views' => 3,
                'comments' => []
            ],
        ];

        foreach ($realData as $item) {
            $normalized = MexicoPhoneHelper::normalize($item['number']);
            $details = MexicoPhoneHelper::getDetails($normalized);

            $phone = Phone::updateOrCreate(
                ['number' => $normalized],
                [
                    'area_code' => $details['area_code'],
                    'location' => $details['location'],
                    'spam_score' => $item['spam_score'],
                    'views' => $item['views'],
                ]
            );

            foreach ($item['comments'] as $comm) {
                Comment::updateOrCreate(
                    [
                        'phone_id' => $phone->id,
                        'content' => $comm['content'],
                    ],
                    [
                        'author_name' => $comm['author_name'],
                        'reason' => $comm['reason'],
                        'ip_hash' => hash('sha256', '127.0.0.1salt2026'),
                        'created_at' => $comm['created_at'],
                    ]
                );
            }
        }
    }
}
