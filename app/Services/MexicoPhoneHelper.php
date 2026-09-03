<?php

namespace App\Services;

class MexicoPhoneHelper
{
    /**
     * Claves LADA oficiales de México según el Instituto Federal de Telecomunicaciones (IFT).
     * Ordenadas de mayor longitud (3 dígitos) a menor (2 dígitos) para matching preciso.
     */
    protected static array $ladaCodes = [
        // Servicios Especiales y Sin Costo (3 dígitos)
        '800' => ['location' => 'Línea Gratuita Nacional (LADA 800 sin costo)', 'state' => 'Nacional', 'type' => 'Línea Sin Costo'],
        '900' => ['location' => 'Servicios Especiales y Valor Agregado', 'state' => 'Nacional', 'type' => 'Servicio Especial'],

        // 2 Dígitos: Principales Áreas Metropolitanas del País
        '55'  => ['location' => 'Ciudad de México (CDMX) y Zona Metropolitana del Valle de México', 'state' => 'Ciudad de México / Estado de México', 'type' => 'Urbano Metropolitano'],
        '56'  => ['location' => 'Ciudad de México (CDMX - Nueva LADA Metropolitana)', 'state' => 'Ciudad de México', 'type' => 'Urbano Metropolitano'],
        '33'  => ['location' => 'Guadalajara, Zapopan, Tlaquepaque y Tonalá', 'state' => 'Jalisco', 'type' => 'Urbano Metropolitano'],
        '81'  => ['location' => 'Monterrey, San Pedro Garza García, San Nicolás y Guadalupe', 'state' => 'Nuevo León', 'type' => 'Urbano Metropolitano'],

        // 3 Dígitos: Ciudades y Regiones de México
        '222' => ['location' => 'Puebla, San Andrés y San Pedro Cholula', 'state' => 'Puebla', 'type' => 'Urbano'],
        '228' => ['location' => 'Xalapa y Coatepec', 'state' => 'Veracruz', 'type' => 'Urbano'],
        '229' => ['location' => 'Veracruz y Boca del Río', 'state' => 'Veracruz', 'type' => 'Urbano'],
        '246' => ['location' => 'Tlaxcala y Apizaco', 'state' => 'Tlaxcala', 'type' => 'Urbano'],
        '311' => ['location' => 'Tepic y Xalisco', 'state' => 'Nayarit', 'type' => 'Urbano'],
        '312' => ['location' => 'Colima y Villa de Álvarez', 'state' => 'Colima', 'type' => 'Urbano'],
        '322' => ['location' => 'Puerto Vallarta y Bahía de Banderas', 'state' => 'Jalisco / Nayarit', 'type' => 'Turístico / Urbano'],
        '442' => ['location' => 'Santiago de Querétaro y San Juan del Río', 'state' => 'Querétaro', 'type' => 'Urbano'],
        '443' => ['location' => 'Morelia', 'state' => 'Michoacán', 'type' => 'Urbano'],
        '444' => ['location' => 'San Luis Potosí y Soledad de Graciano Sánchez', 'state' => 'San Luis Potosí', 'type' => 'Urbano'],
        '449' => ['location' => 'Aguascalientes y Jesús María', 'state' => 'Aguascalientes', 'type' => 'Urbano'],
        '452' => ['location' => 'Uruapan', 'state' => 'Michoacán', 'type' => 'Urbano'],
        '461' => ['location' => 'Celaya', 'state' => 'Guanajuato', 'type' => 'Urbano'],
        '462' => ['location' => 'Irapuato', 'state' => 'Guanajuato', 'type' => 'Urbano'],
        '477' => ['location' => 'León y Silao', 'state' => 'Guanajuato', 'type' => 'Urbano'],
        '492' => ['location' => 'Zacatecas y Guadalupe', 'state' => 'Zacatecas', 'type' => 'Urbano'],
        '493' => ['location' => 'Fresnillo', 'state' => 'Zacatecas', 'type' => 'Urbano'],
        '612' => ['location' => 'La Paz', 'state' => 'Baja California Sur', 'type' => 'Urbano'],
        '614' => ['location' => 'Chihuahua y Aldama', 'state' => 'Chihuahua', 'type' => 'Urbano'],
        '618' => ['location' => 'Victoria de Durango', 'state' => 'Durango', 'type' => 'Urbano'],
        '624' => ['location' => 'Los Cabos (San José del Cabo y Cabo San Lucas)', 'state' => 'Baja California Sur', 'type' => 'Turístico'],
        '631' => ['location' => 'Nogales', 'state' => 'Sonora', 'type' => 'Fronterizo'],
        '644' => ['location' => 'Ciudad Obregón (Cajeme)', 'state' => 'Sonora', 'type' => 'Urbano'],
        '656' => ['location' => 'Ciudad Juárez', 'state' => 'Chihuahua', 'type' => 'Fronterizo / Urbano'],
        '662' => ['location' => 'Hermosillo', 'state' => 'Sonora', 'type' => 'Urbano'],
        '664' => ['location' => 'Tijuana y Playas de Rosarito', 'state' => 'Baja California', 'type' => 'Fronterizo / Urbano'],
        '667' => ['location' => 'Culiacán', 'state' => 'Sinaloa', 'type' => 'Urbano'],
        '668' => ['location' => 'Los Mochis (Ahome)', 'state' => 'Sinaloa', 'type' => 'Urbano'],
        '669' => ['location' => 'Mazatlán', 'state' => 'Sinaloa', 'type' => 'Turístico / Urbano'],
        '686' => ['location' => 'Mexicali', 'state' => 'Baja California', 'type' => 'Fronterizo / Urbano'],
        '722' => ['location' => 'Toluca, Metepec y Zinacantepec', 'state' => 'Estado de México', 'type' => 'Urbano'],
        '744' => ['location' => 'Acapulco de Juárez', 'state' => 'Guerrero', 'type' => 'Turístico / Urbano'],
        '753' => ['location' => 'Lázaro Cárdenas', 'state' => 'Michoacán', 'type' => 'Puerto / Urbano'],
        '771' => ['location' => 'Pachuca de Soto y Mineral de la Reforma', 'state' => 'Hidalgo', 'type' => 'Urbano'],
        '775' => ['location' => 'Tulancingo', 'state' => 'Hidalgo', 'type' => 'Urbano'],
        '777' => ['location' => 'Cuernavaca y Jiutepec', 'state' => 'Morelos', 'type' => 'Urbano'],
        '833' => ['location' => 'Tampico, Ciudad Madero y Altamira', 'state' => 'Tamaulipas', 'type' => 'Urbano / Puerto'],
        '834' => ['location' => 'Ciudad Victoria', 'state' => 'Tamaulipas', 'type' => 'Urbano'],
        '844' => ['location' => 'Saltillo, Ramos Arizpe y Arteaga', 'state' => 'Coahuila', 'type' => 'Urbano'],
        '866' => ['location' => 'Monclova y Frontera', 'state' => 'Coahuila', 'type' => 'Urbano'],
        '867' => ['location' => 'Nuevo Laredo', 'state' => 'Tamaulipas', 'type' => 'Fronterizo'],
        '868' => ['location' => 'Matamoros', 'state' => 'Tamaulipas', 'type' => 'Fronterizo'],
        '871' => ['location' => 'Comarca Lagunera (Torreón, Gómez Palacio y Lerdo)', 'state' => 'Coahuila / Durango', 'type' => 'Urbano Metropolitano'],
        '878' => ['location' => 'Piedras Negras', 'state' => 'Coahuila', 'type' => 'Fronterizo'],
        '899' => ['location' => 'Reynosa', 'state' => 'Tamaulipas', 'type' => 'Fronterizo'],
        '921' => ['location' => 'Coatzacoalcos y Minatitlán', 'state' => 'Veracruz', 'type' => 'Urbano / Industrial'],
        '951' => ['location' => 'Oaxaca de Juárez', 'state' => 'Oaxaca', 'type' => 'Urbano'],
        '958' => ['location' => 'Bahías de Huatulco y Puerto Escondido', 'state' => 'Oaxaca', 'type' => 'Turístico'],
        '961' => ['location' => 'Tuxtla Gutiérrez y Chiapa de Corzo', 'state' => 'Chiapas', 'type' => 'Urbano'],
        '962' => ['location' => 'Tapachula', 'state' => 'Chiapas', 'type' => 'Fronterizo / Urbano'],
        '967' => ['location' => 'San Cristóbal de Las Casas', 'state' => 'Chiapas', 'type' => 'Turístico / Urbano'],
        '981' => ['location' => 'San Francisco de Campeche', 'state' => 'Campeche', 'type' => 'Urbano'],
        '983' => ['location' => 'Chetumal', 'state' => 'Quintana Roo', 'type' => 'Fronterizo / Urbano'],
        '984' => ['location' => 'Playa del Carmen y Tulum (Riviera Maya)', 'state' => 'Quintana Roo', 'type' => 'Turístico'],
        '985' => ['location' => 'Valladolid', 'state' => 'Yucatán', 'type' => 'Turístico / Urbano'],
        '993' => ['location' => 'Villahermosa', 'state' => 'Tabasco', 'type' => 'Urbano'],
        '998' => ['location' => 'Cancún e Isla Mujeres', 'state' => 'Quintana Roo', 'type' => 'Turístico / Urbano'],
        '999' => ['location' => 'Mérida y Progreso', 'state' => 'Yucatán', 'type' => 'Urbano Metropolitano'],
    ];

    /**
     * Normaliza cualquier formato mexicano a 10 dígitos canónicos oficiales del IFT.
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

        // Quitar prefijo de salida internacional '0052'
        if (str_starts_with($clean, '0052')) {
            $clean = substr($clean, 4);
        }

        // Quitar prefijo internacional '52' o '521' (móvil internacional previo a 2019)
        if (str_starts_with($clean, '521') && strlen($clean) === 13) {
            $clean = substr($clean, 3);
        } elseif (str_starts_with($clean, '52') && strlen($clean) === 12) {
            $clean = substr($clean, 2);
        }

        // Quitar prefijos antiguos de larga distancia nacional y celular (01, 044, 045)
        if ((str_starts_with($clean, '044') || str_starts_with($clean, '045')) && strlen($clean) === 13) {
            $clean = substr($clean, 3);
        } elseif (str_starts_with($clean, '01') && strlen($clean) === 12) {
            $clean = substr($clean, 2);
        }

        // En México, el Plan Técnico Fundamental de Numeración es estrictamente a 10 dígitos
        if (strlen($clean) === 10) {
            return $clean;
        }

        // Si el usuario ingresó 7 u 8 dígitos (marcado local antiguo de CDMX/Guadalajara/Monterrey)
        // No se puede inferir con certeza la LADA, pero si tiene entre 10 y 12 dígitos residuales, limpiamos
        if (strlen($clean) > 10 && str_starts_with($clean, '52')) {
            $clean = substr($clean, 2);
            if (strlen($clean) === 10) {
                return $clean;
            }
        }

        return (strlen($clean) === 10) ? $clean : null;
    }

    /**
     * Formatea un número de 10 dígitos para lectura visual:
     * Para LADA de 2 dígitos (55, 56, 33, 81): (55) 1234 5678
     * Para LADA de 3 dígitos (222, 664, 442, etc.): (222) 123 4567
     */
    public static function format(?string $number): string
    {
        $normalized = self::normalize($number);
        if (!$normalized || strlen($normalized) !== 10) {
            return $number ?? '';
        }

        // Claves LADA metropolitanas de 2 dígitos
        $prefix2 = substr($normalized, 0, 2);
        if (in_array($prefix2, ['55', '56', '33', '81'])) {
            return sprintf("(%s) %s %s", $prefix2, substr($normalized, 2, 4), substr($normalized, 6, 4));
        }

        // Claves LADA de 3 dígitos
        $prefix3 = substr($normalized, 0, 3);
        return sprintf("(%s) %s %s", $prefix3, substr($normalized, 3, 3), substr($normalized, 6, 4));
    }

    /**
     * Obtiene los detalles geográficos y técnicos según la clave LADA del IFT.
     */
    public static function getDetails(string $number): array
    {
        $normalized = self::normalize($number);
        if (!$normalized) {
            return [
                'type' => 'Desconocido',
                'location' => 'México (Número no identificado)',
                'state' => 'México',
                'city' => 'México',
                'lada' => '',
                'is_mobile' => false,
                'is_special' => false,
            ];
        }

        // Intentar primero clave de 3 dígitos
        $p3 = substr($normalized, 0, 3);
        if (isset(self::$ladaCodes[$p3])) {
            $info = self::$ladaCodes[$p3];
            return [
                'type' => $info['type'],
                'location' => $info['location'],
                'state' => $info['state'],
                'city' => explode(',', $info['location'])[0],
                'lada' => $p3,
                'area_code' => $p3,
                'is_mobile' => false,
                'is_special' => ($p3 === '800' || $p3 === '900'),
            ];
        }

        // Intentar clave de 2 dígitos (55, 56, 33, 81)
        $p2 = substr($normalized, 0, 2);
        if (isset(self::$ladaCodes[$p2])) {
            $info = self::$ladaCodes[$p2];
            return [
                'type' => $info['type'],
                'location' => $info['location'],
                'state' => $info['state'],
                'city' => explode(',', $info['location'])[0],
                'lada' => $p2,
                'area_code' => $p2,
                'is_mobile' => false,
                'is_special' => false,
            ];
        }

        return [
            'type' => 'Línea Telefónica Nacional IFT',
            'location' => 'México (Red Nacional IFT)',
            'state' => 'México',
            'city' => 'México',
            'lada' => substr($normalized, 0, 3),
            'area_code' => substr($normalized, 0, 3),
            'is_mobile' => false,
            'is_special' => false,
        ];
    }

    /**
     * Obtiene la información de la clave LADA para el guardado en la base de datos.
     */
    public static function getLadaInfo(string $number): array
    {
        $details = self::getDetails($number);
        return [
            'code' => $details['lada'] ?: substr(self::normalize($number) ?? '', 0, 3),
            'location' => $details['location'],
            'state' => $details['state'],
            'type' => $details['type'],
        ];
    }

    /**
     * Información de marcación nacional e internacional para México (IFT).
     */
    public static function getDialingInfo(string $number): array
    {
        $clean = self::normalize($number);
        $formatted = self::format($clean);

        return [
            'national' => $formatted,
            'international' => '+52 ' . $formatted,
            'from_usa' => '011 52 ' . $formatted,
            'whatsapp' => 'https://api.whatsapp.com/send?phone=52' . $clean,
            'clean' => $clean,
        ];
    }

    /**
     * Retorna todas las claves LADA registradas.
     */
    public static function getAllLadas(): array
    {
        return self::$ladaCodes;
    }
}
