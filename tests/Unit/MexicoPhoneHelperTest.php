<?php

namespace Tests\Unit;

use App\Services\MexicoPhoneHelper;
use PHPUnit\Framework\TestCase;

class MexicoPhoneHelperTest extends TestCase
{
    public function test_normalizes_10_digit_numbers()
    {
        // Con prefijo internacional +52
        $this->assertEquals('5588982939', MexicoPhoneHelper::normalize('+52 55 8898 2939'));
        $this->assertEquals('5588982939', MexicoPhoneHelper::normalize('+5215588982939'));
        $this->assertEquals('5588982939', MexicoPhoneHelper::normalize('00525588982939'));

        // Con prefijos históricos 01, 044, 045
        $this->assertEquals('5588982939', MexicoPhoneHelper::normalize('01 55 8898 2939'));
        $this->assertEquals('5588982939', MexicoPhoneHelper::normalize('044 55 8898 2939'));
        $this->assertEquals('5588982939', MexicoPhoneHelper::normalize('045 55 8898 2939'));

        // Directo 10 dígitos
        $this->assertEquals('3312826188', MexicoPhoneHelper::normalize('33-1282-6188'));
        $this->assertEquals('8135325694', MexicoPhoneHelper::normalize('(81) 3532 5694'));
    }

    public function test_formats_metropolitan_and_regional_numbers()
    {
        // 2 dígitos LADA (CDMX 55, Guadalajara 33, Monterrey 81)
        $this->assertEquals('(55) 8898 2939', MexicoPhoneHelper::format('5588982939'));
        $this->assertEquals('(33) 1282 6188', MexicoPhoneHelper::format('3312826188'));

        // 3 dígitos LADA (Puebla 222, Querétaro 442)
        $this->assertEquals('(222) 123 4567', MexicoPhoneHelper::format('2221234567'));
    }

    public function test_identifies_location_and_details()
    {
        $detailsCdmx = MexicoPhoneHelper::getDetails('5588982939');
        $this->assertEquals('55', $detailsCdmx['area_code']);
        $this->assertStringContainsString('Ciudad de México', $detailsCdmx['location']);

        $detailsGdl = MexicoPhoneHelper::getDetails('3312826188');
        $this->assertEquals('33', $detailsGdl['area_code']);
        $this->assertStringContainsString('Guadalajara', $detailsGdl['location']);

        $detailsMty = MexicoPhoneHelper::getDetails('8135325694');
        $this->assertEquals('81', $detailsMty['area_code']);
        $this->assertStringContainsString('Monterrey', $detailsMty['location']);
    }
}
