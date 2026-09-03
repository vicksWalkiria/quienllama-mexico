<?php

namespace Database\Seeders;

use App\Models\Phone;
use App\Models\Comment;
use App\Services\ChilePhoneHelper;
use Illuminate\Database\Seeder;

class ChilePhonesSeeder extends Seeder
{
    public function run(): void
    {
        $sampleData = [
            // Celulares spam (prefijo 9)
            [
                'number' => '987654321',
                'views' => 1240,
                'spam_score' => 15,
                'comments' => [
                    ['author_name' => 'Marcela P.', 'reason' => 'Telemarketing', 'content' => 'Llaman ofreciendo planes de telefonía e internet a toda hora, insoportables.'],
                    ['author_name' => 'Gonzalo S.', 'reason' => 'Llamada Silenciosa', 'content' => 'Atiendo y se corta inmediatamente una máquina. Robocall pura.'],
                ]
            ],
            [
                'number' => '944556677',
                'views' => 890,
                'spam_score' => 22,
                'comments' => [
                    ['author_name' => 'Rodrigo M.', 'reason' => 'Estafa / Phishing', 'content' => 'Dicen ser de BancoEstado alertando sobre bloqueo de CuentaRUT y piden ingresar a un link.'],
                    ['author_name' => 'Camila V.', 'reason' => 'Estafa / Phishing', 'content' => 'Intento de estafa bancaria. Te piden la tercera clave del banco.'],
                ]
            ],
            [
                'number' => '971234567',
                'views' => 650,
                'spam_score' => 8,
                'comments' => [
                    ['author_name' => 'Ignacio T.', 'reason' => 'Telemarketing', 'content' => 'Venta de seguros de salud y accidentes. Insistentes aunque les digas que no.'],
                ]
            ],
            [
                'number' => '963214587',
                'views' => 430,
                'spam_score' => 6,
                'comments' => [
                    ['author_name' => 'Felipe B.', 'reason' => 'Cobro de Deudas', 'content' => 'Cobranzas de retail comercial preguntando por una persona que no conozco.'],
                ]
            ],
            [
                'number' => '955443322',
                'views' => 1120,
                'spam_score' => 18,
                'comments' => [
                    ['author_name' => 'Paulina K.', 'reason' => 'Telemarketing', 'content' => 'Cambio de compañía de telefonía móvil. Llaman hasta 4 veces al día.'],
                    ['author_name' => 'Matías G.', 'reason' => 'Llamada Silenciosa', 'content' => 'Llaman, contesto "aló" y nadie habla, luego una voz en inglés dice goodbye y cortan.'],
                ]
            ],
            // Santiago (prefijo 2)
            [
                'number' => '222345678',
                'views' => 1520,
                'spam_score' => 25,
                'comments' => [
                    ['author_name' => 'Claudio R.', 'reason' => 'Telemarketing', 'content' => 'Call center desde Santiago vendiendo créditos de consumo y tarjetas de crédito.'],
                    ['author_name' => 'Francisca H.', 'reason' => 'Telemarketing', 'content' => 'Ofrecen tarjetas adicionales de casa comercial. Ya los inscribí en No Molestar de SERNAC.'],
                ]
            ],
            [
                'number' => '223456789',
                'views' => 780,
                'spam_score' => 12,
                'comments' => [
                    ['author_name' => 'Daniela L.', 'reason' => 'Llamada Silenciosa', 'content' => 'Llamada muda automática. Marcan a las 9 de la mañana y a las 8 de la noche.'],
                ]
            ],
            [
                'number' => '228901234',
                'views' => 930,
                'spam_score' => 14,
                'comments' => [
                    ['author_name' => 'Sebastián F.', 'reason' => 'Cobro de Deudas', 'content' => 'Estudio de cobranza judicial por deuda bancaria ajena.'],
                ]
            ],
            // Valparaíso / Viña del Mar (prefijo 32)
            [
                'number' => '322123456',
                'views' => 610,
                'spam_score' => 9,
                'comments' => [
                    ['author_name' => 'Andrés C.', 'reason' => 'Telemarketing', 'content' => 'Promoción de servicios turísticos y hotelería en la V Región.'],
                ]
            ],
            // Concepción (prefijo 41)
            [
                'number' => '412345678',
                'views' => 540,
                'spam_score' => 7,
                'comments' => [
                    ['author_name' => 'Cristián A.', 'reason' => 'Telemarketing', 'content' => 'Call center ofreciendo alarmas para el hogar.'],
                ]
            ],
            // Telefonía IP / VoIP (prefijo 44)
            [
                'number' => '442170328',
                'views' => 1840,
                'spam_score' => 31,
                'comments' => [
                    ['author_name' => 'Loreto M.', 'reason' => 'Estafa / Phishing', 'content' => 'Línea VoIP. Llaman haciéndose pasar por Correos de Chile por un supuesto paquete retenido.'],
                    ['author_name' => 'Nicolás E.', 'reason' => 'Llamada Silenciosa', 'content' => 'Marcador automático VoIP de llamadas masivas.'],
                ]
            ],
            // Antofagasta (prefijo 55)
            [
                'number' => '552345678',
                'views' => 420,
                'spam_score' => 5,
                'comments' => [
                    ['author_name' => 'Esteban Z.', 'reason' => 'Telemarketing', 'content' => 'Venta de cursos y capacitaciones online.'],
                ]
            ],
            // La Serena (prefijo 51)
            [
                'number' => '512345678',
                'views' => 390,
                'spam_score' => 4,
                'comments' => [
                    ['author_name' => 'Valeria B.', 'reason' => 'Telemarketing', 'content' => 'Seguros dentales y automotrices.'],
                ]
            ],
            // Temuco (prefijo 45)
            [
                'number' => '452345678',
                'views' => 460,
                'spam_score' => 6,
                'comments' => [
                    ['author_name' => 'Jorge P.', 'reason' => 'Cobro de Deudas', 'content' => 'Cobranzas de multitiendas.'],
                ]
            ],
            // Puerto Montt (prefijo 65)
            [
                'number' => '652345678',
                'views' => 350,
                'spam_score' => 4,
                'comments' => [
                    ['author_name' => 'Manuel D.', 'reason' => 'Llamada Silenciosa', 'content' => 'Llaman y no responden, cortan a los 3 segundos.'],
                ]
            ],
        ];

        foreach ($sampleData as $item) {
            $details = ChilePhoneHelper::getDetails($item['number']);

            $phone = Phone::updateOrCreate(
                ['number' => $item['number']],
                [
                    'area_code' => $details['area_code'],
                    'location' => $details['location'],
                    'spam_score' => $item['spam_score'],
                    'views' => $item['views'],
                ]
            );

            foreach ($item['comments'] as $comm) {
                Comment::create([
                    'phone_id' => $phone->id,
                    'author_name' => $comm['author_name'],
                    'reason' => $comm['reason'],
                    'content' => $comm['content'],
                    'ip_hash' => hash('sha256', 'seed-' . $comm['author_name']),
                ]);
            }
        }
    }
}
