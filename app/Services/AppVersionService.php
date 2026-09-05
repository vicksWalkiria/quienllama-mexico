<?php

namespace App\Services;

class AppVersionService
{
    /**
     * Registro y seguimiento centralizado de versiones móviles (Android e iOS)
     * Mantiene retrocompatibilidad para versiones anteriores (aviso suave sin forzar)
     */
    const VERSIONS = [
        'android' => [
            'latest_version' => 7,
            'latest_version_name' => '1.0.6',
            'min_version' => 5, // Retrocompatibilidad: versiones 5 y 6 pueden seguir usándose con aviso suave
            'update_url' => 'https://play.google.com/store/apps/details?id=com.walkiria.quienllama',
            'title' => 'Nueva versión disponible',
            'message' => 'Actualiza QuiénLlama para seguir disfrutando de la máxima protección contra llamadas de spam y números sospechosos.',
            'history' => [
                7 => ['name' => '1.0.6', 'date' => '2026-09-06', 'notes' => 'Avisador contactos, estabilidad de sincronización y control de versiones'],
                6 => ['name' => '1.0.5', 'date' => '2026-09-06', 'notes' => 'Avisador contactos, eliminación de parpadeo de rol, semillas reales multipaís, control de versiones'],
                5 => ['name' => '1.0.4', 'date' => '2026-09-01', 'notes' => 'Soporte Play Integrity, optimización de SQLite'],
                4 => ['name' => '1.0.3', 'date' => '2026-08-20', 'notes' => 'Integración de AdMob y suscripción PRO'],
                3 => ['name' => '1.0.2', 'date' => '2026-08-10', 'notes' => 'Filtro inicial de Call Screening'],
                2 => ['name' => '1.0.1', 'date' => '2026-08-01', 'notes' => 'Mejoras de rendimiento'],
                1 => ['name' => '1.0.0', 'date' => '2026-07-15', 'notes' => 'Lanzamiento inicial']
            ]
        ],
        'ios' => [
            'latest_version' => 1,
            'latest_version_name' => '1.0.0',
            'min_version' => 1,
            'update_url' => 'https://apps.apple.com/app/id6740000000',
            'title' => 'Nueva versión disponible',
            'message' => 'Actualiza QuiénLlama desde App Store para mantener tu filtro de llamadas al día.',
            'history' => [
                1 => ['name' => '1.0.0', 'date' => '2026-09-06', 'notes' => 'Lanzamiento inicial Call Directory Extension iOS']
            ]
        ]
    ];

    /**
     * Comprueba la versión del cliente móvil con margen de retrocompatibilidad.
     */
    public static function checkVersion($os, $clientVersion)
    {
        $os = strtolower(trim((string)$os));
        $clientVersion = intval($clientVersion);

        if (empty($os) || !isset(self::VERSIONS[$os])) {
            return null;
        }

        $cfg = self::VERSIONS[$os];
        $isOutdated = ($clientVersion > 0 && $clientVersion < $cfg['latest_version']);
        $isForce = ($clientVersion > 0 && $clientVersion < $cfg['min_version']);

        return [
            'update_available' => $isOutdated,
            'force_update' => $isForce,
            'current_version' => $clientVersion,
            'latest_version' => $cfg['latest_version'],
            'latest_version_name' => $cfg['latest_version_name'],
            'min_version' => $cfg['min_version'],
            'title' => $cfg['title'],
            'message' => $cfg['message'],
            'store_url' => $cfg['update_url']
        ];
    }

    public static function getVersionHistory($os)
    {
        $os = strtolower(trim((string)$os));
        return self::VERSIONS[$os]['history'] ?? [];
    }

    public static function getAllVersions()
    {
        return self::VERSIONS;
    }
}
