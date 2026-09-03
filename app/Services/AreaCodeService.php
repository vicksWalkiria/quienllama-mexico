<?php

namespace App\Services;

class AreaCodeService
{
    /**
     * Catálogo de Claves LADA Oficiales de México (IFT).
     */
    protected static array $codes = [
        // Zona Metropolitana y Centro
        '55'  => ['city' => 'Ciudad de México (CDMX) y Valle de México', 'region' => 'Valle de México', 'volume' => 95000, 'is_major' => true],
        '56'  => ['city' => 'Ciudad de México (CDMX - Nueva LADA)', 'region' => 'Valle de México', 'volume' => 35000, 'is_major' => true],
        '722' => ['city' => 'Toluca, Metepec y Lerma', 'region' => 'Estado de México', 'volume' => 24000, 'is_major' => true],
        '222' => ['city' => 'Puebla y Cholula', 'region' => 'Puebla', 'volume' => 31000, 'is_major' => true],
        '777' => ['city' => 'Cuernavaca y Jiutepec', 'region' => 'Morelos', 'volume' => 18000, 'is_major' => true],
        '771' => ['city' => 'Pachuca de Soto', 'region' => 'Hidalgo', 'volume' => 14000, 'is_major' => true],
        '246' => ['city' => 'Tlaxcala y Apizaco', 'region' => 'Tlaxcala', 'volume' => 9000, 'is_major' => false],

        // Occidente y Bajío
        '33'  => ['city' => 'Guadalajara, Zapopan y Tlaquepaque', 'region' => 'Jalisco', 'volume' => 68000, 'is_major' => true],
        '322' => ['city' => 'Puerto Vallarta y Bahía de Banderas', 'region' => 'Jalisco / Nayarit', 'volume' => 15000, 'is_major' => true],
        '477' => ['city' => 'León y Silao', 'region' => 'Guanajuato', 'volume' => 26000, 'is_major' => true],
        '462' => ['city' => 'Irapuato', 'region' => 'Guanajuato', 'volume' => 13000, 'is_major' => false],
        '461' => ['city' => 'Celaya', 'region' => 'Guanajuato', 'volume' => 14000, 'is_major' => false],
        '442' => ['city' => 'Santiago de Querétaro y San Juan del Río', 'region' => 'Querétaro', 'volume' => 29000, 'is_major' => true],
        '449' => ['city' => 'Aguascalientes', 'region' => 'Aguascalientes', 'volume' => 19000, 'is_major' => true],
        '444' => ['city' => 'San Luis Potosí', 'region' => 'San Luis Potosí', 'volume' => 21000, 'is_major' => true],
        '443' => ['city' => 'Morelia', 'region' => 'Michoacán', 'volume' => 20000, 'is_major' => true],
        '311' => ['city' => 'Tepic', 'region' => 'Nayarit', 'volume' => 11000, 'is_major' => false],
        '312' => ['city' => 'Colima y Manzanillo', 'region' => 'Colima', 'volume' => 10000, 'is_major' => false],

        // Norte y Noreste
        '81'  => ['city' => 'Monterrey, San Pedro y San Nicolás', 'region' => 'Nuevo León', 'volume' => 62000, 'is_major' => true],
        '844' => ['city' => 'Saltillo y Ramos Arizpe', 'region' => 'Coahuila', 'volume' => 18000, 'is_major' => true],
        '871' => ['city' => 'Torreón, Gómez Palacio y Lerdo (La Laguna)', 'region' => 'Coahuila / Durango', 'volume' => 22000, 'is_major' => true],
        '833' => ['city' => 'Tampico, Madero y Altamira', 'region' => 'Tamaulipas', 'volume' => 16000, 'is_major' => true],
        '899' => ['city' => 'Reynosa', 'region' => 'Tamaulipas', 'volume' => 15000, 'is_major' => true],
        '868' => ['city' => 'Matamoros', 'region' => 'Tamaulipas', 'volume' => 14000, 'is_major' => true],
        '867' => ['city' => 'Nuevo Laredo', 'region' => 'Tamaulipas', 'volume' => 13000, 'is_major' => true],
        '618' => ['city' => 'Durango', 'region' => 'Durango', 'volume' => 12000, 'is_major' => false],
        '492' => ['city' => 'Zacatecas', 'region' => 'Zacatecas', 'volume' => 11000, 'is_major' => false],

        // Noroeste y Frontera
        '664' => ['city' => 'Tijuana y Playas de Rosarito', 'region' => 'Baja California', 'volume' => 38000, 'is_major' => true],
        '686' => ['city' => 'Mexicali', 'region' => 'Baja California', 'volume' => 21000, 'is_major' => true],
        '656' => ['city' => 'Ciudad Juárez', 'region' => 'Chihuahua', 'volume' => 27000, 'is_major' => true],
        '614' => ['city' => 'Chihuahua capital', 'region' => 'Chihuahua', 'volume' => 23000, 'is_major' => true],
        '662' => ['city' => 'Hermosillo', 'region' => 'Sonora', 'volume' => 22000, 'is_major' => true],
        '644' => ['city' => 'Ciudad Obregón', 'region' => 'Sonora', 'volume' => 12000, 'is_major' => false],
        '667' => ['city' => 'Culiacán', 'region' => 'Sinaloa', 'volume' => 24000, 'is_major' => true],
        '669' => ['city' => 'Mazatlán', 'region' => 'Sinaloa', 'volume' => 15000, 'is_major' => true],
        '624' => ['city' => 'Los Cabos (San José y Cabo San Lucas)', 'region' => 'Baja California Sur', 'volume' => 16000, 'is_major' => true],
        '612' => ['city' => 'La Paz', 'region' => 'Baja California Sur', 'volume' => 12000, 'is_major' => false],

        // Sur, Golfo y Península de Yucatán
        '229' => ['city' => 'Veracruz y Boca del Río', 'region' => 'Veracruz', 'volume' => 22000, 'is_major' => true],
        '228' => ['city' => 'Xalapa', 'region' => 'Veracruz', 'volume' => 17000, 'is_major' => true],
        '998' => ['city' => 'Cancún, Riviera Maya e Isla Mujeres', 'region' => 'Quintana Roo', 'volume' => 32000, 'is_major' => true],
        '984' => ['city' => 'Playa del Carmen y Tulum', 'region' => 'Quintana Roo', 'volume' => 21000, 'is_major' => true],
        '999' => ['city' => 'Mérida y Progreso', 'region' => 'Yucatán', 'volume' => 28000, 'is_major' => true],
        '993' => ['city' => 'Villahermosa', 'region' => 'Tabasco', 'volume' => 18000, 'is_major' => true],
        '961' => ['city' => 'Tuxtla Gutiérrez y Chiapa de Corzo', 'region' => 'Chiapas', 'volume' => 16000, 'is_major' => true],
        '951' => ['city' => 'Oaxaca de Juárez', 'region' => 'Oaxaca', 'volume' => 17000, 'is_major' => true],
        '744' => ['city' => 'Acapulco de Juárez', 'region' => 'Guerrero', 'volume' => 19000, 'is_major' => true],
        '981' => ['city' => 'Campeche', 'region' => 'Campeche', 'volume' => 9000, 'is_major' => false],

        // Especiales
        '800' => ['city' => 'Línea Gratuita Nacional (LADA 800 sin costo)', 'region' => 'Nacional', 'volume' => 15000, 'is_major' => false],
        '900' => ['city' => 'Línea de Tarifa Especial / Entretenimiento', 'region' => 'Nacional', 'volume' => 5000, 'is_major' => false],
    ];

    public static function all(): array
    {
        return self::$codes;
    }

    public static function getAll(): array
    {
        return self::$codes;
    }

    public static function find(string $code): ?array
    {
        return self::$codes[$code] ?? null;
    }

    public static function getGroupedByRegion(): array
    {
        $grouped = [];
        foreach (self::$codes as $code => $data) {
            $data['code'] = $code;
            $grouped[$data['region']][] = $data;
        }
        return $grouped;
    }

    public static function getTopPopular(int $limit = 12): array
    {
        $list = self::$codes;
        uasort($list, fn($a, $b) => $b['volume'] <=> $a['volume']);
        $result = [];
        $i = 0;
        foreach ($list as $code => $data) {
            $data['code'] = $code;
            $result[] = $data;
            if (++$i >= $limit) break;
        }
        return $result;
    }
}
