<?php

namespace App\Services;

class ChilePhoneHelper
{
    /**
     * Códigos de área y sus ubicaciones en Chile según SUBTEL.
     * Ordenados por longitud decreciente para matchear correctamente.
     */
    protected static array $areaCodes = [
        // Especiales y VoIP (3 y 2 dígitos)
        '800' => 'Línea Gratuita Nacional (Cobro Revertido)',
        '600' => 'Línea de Tarifa Compartida Nacional (Empresas)',
        '809' => 'Llamadas Masivas Comerciales (Telemarketing SUBTEL)',
        '44'  => 'Telefonía IP / Voz sobre IP (VoIP Nacional)',

        // Región Metropolitana (1 dígito de código de área + 8 locales)
        '2'   => 'Santiago y Región Metropolitana',

        // 2 dígitos - Regiones del Norte
        '58'  => 'Arica y Parinacota (Arica)',
        '57'  => 'Tarapacá (Iquique y Alto Hospicio)',
        '55'  => 'Antofagasta (Antofagasta, Calama y Tocopilla)',
        '52'  => 'Atacama (Copiapó y Vallenar)',
        '51'  => 'Coquimbo (La Serena y Coquimbo)',
        '53'  => 'Coquimbo (Ovalle e Illapel)',

        // 2 dígitos - Regiones Centro
        '32'  => 'Valparaíso (Valparaíso, Viña del Mar y Concón)',
        '33'  => 'Valparaíso (Quillota y La Calera)',
        '34'  => 'Valparaíso (Los Andes y San Felipe)',
        '35'  => 'Valparaíso (San Antonio y Litoral Central)',
        '72'  => 'O\'Higgins (Rancagua y San Fernando)',
        '75'  => 'Maule (Curicó y Molina)',
        '71'  => 'Maule (Talca y Constitución)',
        '73'  => 'Maule (Linares y Cauquenes)',

        // 2 dígitos - Regiones Sur y Austral
        '42'  => 'Ñuble (Chillán y San Carlos)',
        '41'  => 'Biobío (Gran Concepción y Talcahuano)',
        '43'  => 'Biobío (Los Ángeles y cordillera)',
        '45'  => 'La Araucanía (Temuco, Villarrica y Pucón)',
        '63'  => 'Los Ríos (Valdivia y La Unión)',
        '64'  => 'Los Lagos (Osorno y Purranque)',
        '65'  => 'Los Lagos (Puerto Montt, Puerto Varas y Chiloé)',
        '67'  => 'Aysén (Coyhaique y Puerto Aysén)',
        '61'  => 'Magallanes y Antártica Chilena (Punta Arenas)',
    ];

    /**
     * Normaliza cualquier formato chileno ingresado por un usuario a 9 dígitos canónicos.
     */
    public static function normalize(?string $input): ?string
    {
        if (empty($input)) {
            return null;
        }

        $clean = preg_replace('/[^0-9]/', '', $input);

        if (empty($clean)) {
            return null;
        }

        // Si empieza con prefijo internacional de Chile '56'
        if (str_starts_with($clean, '56') && strlen($clean) > 9) {
            $clean = substr($clean, 2);
        }

        // Si empieza por '09' (marcado común celular), quitar el 0 inicial
        if (str_starts_with($clean, '09') && strlen($clean) === 10) {
            $clean = substr($clean, 1);
        }

        // Si empieza por '0' simple seguido de código de área (ej: 02, 032, etc.)
        if (str_starts_with($clean, '0') && strlen($clean) === 10) {
            $clean = substr($clean, 1);
        }

        // En Chile el plan unificado nacional tiene exactamente 9 dígitos
        if (strlen($clean) === 9) {
            if (self::isValidPrefix($clean)) {
                return $clean;
            }
            return null;
        }

        // Si el usuario ingresó 8 dígitos (celular antiguo sin el 9 o fijo sin el 2)
        if (strlen($clean) === 8) {
            if (in_array($clean[0], ['4', '5', '6', '7', '8'])) {
                return '9' . $clean;
            }
            if (in_array($clean[0], ['2', '3'])) {
                return '2' . $clean;
            }
        }

        return null;
    }

    /**
     * Verifica si los 9 dígitos inician con un prefijo válido en Chile.
     */
    public static function isValidPrefix(string $clean): bool
    {
        if (strlen($clean) !== 9) {
            return false;
        }

        // Móvil (9) o Fijo Santiago (2)
        if (str_starts_with($clean, '9') || str_starts_with($clean, '2')) {
            return true;
        }

        // Especiales (800, 600, 809)
        $p3 = substr($clean, 0, 3);
        if (in_array($p3, ['800', '600', '809'])) {
            return true;
        }

        // VoIP (44) o Fijos regionales
        $p2 = substr($clean, 0, 2);
        return isset(self::$areaCodes[$p2]);
    }

    /**
     * Formatea el número canónico de 9 dígitos para presentación visual elegante.
     */
    public static function format(string $number, bool $withCountryCode = false): string
    {
        $clean = self::normalize($number) ?? $number;

        if (strlen($clean) !== 9) {
            return $clean;
        }

        $prefix = $withCountryCode ? '+56 ' : '';

        // Celular: 9 XXXX XXXX
        if (str_starts_with($clean, '9')) {
            return $prefix . '9 ' . substr($clean, 1, 4) . ' ' . substr($clean, 5, 4);
        }

        // Fijo Santiago: 2 2XXX XXXX
        if (str_starts_with($clean, '2')) {
            return $prefix . '2 ' . substr($clean, 1, 4) . ' ' . substr($clean, 5, 4);
        }

        // Especiales 800 / 600 / 809: 800 XXX XXX
        if (in_array(substr($clean, 0, 3), ['800', '600', '809'])) {
            return substr($clean, 0, 3) . ' ' . substr($clean, 3, 3) . ' ' . substr($clean, 6, 3);
        }

        // Códigos de 2 dígitos regionales: 32 2XX XXXX
        $area2 = substr($clean, 0, 2);
        if (isset(self::$areaCodes[$area2])) {
            return $prefix . $area2 . ' ' . substr($clean, 2, 3) . ' ' . substr($clean, 5, 4);
        }

        return $prefix . substr($clean, 0, 1) . ' ' . substr($clean, 1, 4) . ' ' . substr($clean, 5, 4);
    }

    /**
     * Detecta el código de área y la localidad correspondiente.
     */
    public static function getAreaInfo(string $number): array
    {
        $digits = self::normalize($number) ?? $number;

        // Celular
        if (str_starts_with($digits, '9')) {
            return [
                'code' => '9',
                'location' => 'Chile (Red Celular Móvil)',
                'city' => 'Chile (Red Celular Móvil)',
                'is_mobile' => true,
                'is_special' => false,
            ];
        }

        // Especiales 3 dígitos
        $p3 = substr($digits, 0, 3);
        if (isset(self::$areaCodes[$p3])) {
            return [
                'code' => $p3,
                'location' => self::$areaCodes[$p3],
                'city' => self::$areaCodes[$p3],
                'is_mobile' => false,
                'is_special' => true,
            ];
        }

        // VoIP (44)
        if (str_starts_with($digits, '44')) {
            return [
                'code' => '44',
                'location' => self::$areaCodes['44'],
                'city' => 'Telefonía IP Nacional',
                'is_mobile' => false,
                'is_special' => true,
            ];
        }

        // Santiago (2)
        if (str_starts_with($digits, '2')) {
            return [
                'code' => '2',
                'location' => self::$areaCodes['2'],
                'city' => self::$areaCodes['2'],
                'is_mobile' => false,
                'is_special' => false,
            ];
        }

        // Fijos 2 dígitos
        $p2 = substr($digits, 0, 2);
        if (isset(self::$areaCodes[$p2])) {
            return [
                'code' => $p2,
                'location' => self::$areaCodes[$p2],
                'city' => self::$areaCodes[$p2],
                'is_mobile' => false,
                'is_special' => false,
            ];
        }

        return [
            'code' => null,
            'location' => 'Chile',
            'city' => 'Chile',
            'is_mobile' => false,
            'is_special' => false,
        ];
    }

    /**
     * Información detallada de marcado para la ficha.
     */
    public static function getDialingInfo(string $number): array
    {
        $clean = self::normalize($number) ?? $number;
        $area = self::getAreaInfo($clean);

        return [
            'national' => $clean,
            'international' => '+56 ' . $clean,
            'whatsapp' => 'https://wa.me/56' . $clean,
            'formatted' => self::format($clean),
            'location' => $area['location'],
            'is_mobile' => $area['is_mobile'],
            'is_special' => $area['is_special'],
        ];
    }

    /**
     * Retorna detalles enriquecidos del número (tipo de línea, región, ciudad).
     */
    public static function getDetails(string $number): array
    {
        $clean = self::normalize($number) ?? $number;
        $area = self::getAreaInfo($clean);

        return [
            'type'       => $area['is_mobile'] ? 'Celular / Telefonía Móvil' : ($area['is_special'] ? 'Servicio Especial / VoIP' : 'Teléfono Fijo'),
            'location'   => $area['location'],
            'region'     => $area['location'],
            'city'       => $area['location'],
            'area_code'  => $area['code'],
            'is_mobile'  => $area['is_mobile'],
            'is_special' => $area['is_special'],
        ];
    }

    /**
     * Valida si un número cumple el estándar telefónico chileno de 9 dígitos.
     */
    public static function isValid(string $number): bool
    {
        $clean = self::normalize($number);
        return $clean !== null && strlen($clean) === 9 && ctype_digit($clean);
    }

    /**
     * Devuelve el catálogo completo de prefijos ordenado por región.
     */
    public static function getAllAreaCodes(): array
    {
        return self::$areaCodes;
    }
}
