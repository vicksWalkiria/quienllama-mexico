<?php

namespace Tests\Unit;

use App\Services\ChilePhoneHelper;
use PHPUnit\Framework\TestCase;

class ChilePhoneHelperTest extends TestCase
{
    public function test_normalizes_various_chilean_phone_formats(): void
    {
        // 1. Móvil con código internacional (+56 9)
        $this->assertEquals('987654321', ChilePhoneHelper::normalize('+56 9 8765-4321'));
        $this->assertEquals('987654321', ChilePhoneHelper::normalize('56987654321'));
        $this->assertEquals('987654321', ChilePhoneHelper::normalize('987654321'));

        // 2. Fijo Santiago (+56 2)
        $this->assertEquals('222345678', ChilePhoneHelper::normalize('+56 2 2234-5678'));
        $this->assertEquals('222345678', ChilePhoneHelper::normalize('56222345678'));
        $this->assertEquals('222345678', ChilePhoneHelper::normalize('222345678'));

        // 3. Fijo Regional Valparaíso (+56 32)
        $this->assertEquals('322123456', ChilePhoneHelper::normalize('+56 32 212 3456'));
        $this->assertEquals('322123456', ChilePhoneHelper::normalize('322123456'));

        // 4. VoIP (+56 44)
        $this->assertEquals('442170328', ChilePhoneHelper::normalize('+56 44 217 0328'));
    }

    public function test_rejects_non_chilean_or_invalid_numbers(): void
    {
        // Número español que no existe en Chile (601 no es código chileno)
        $this->assertNull(ChilePhoneHelper::normalize('601234567'));
        $this->assertNull(ChilePhoneHelper::normalize('123456789'));

        // Número demasiado corto o vacío
        $this->assertNull(ChilePhoneHelper::normalize(''));
        $this->assertNull(ChilePhoneHelper::normalize('12345'));
    }

    public function test_detects_correct_area_codes_and_locations(): void
    {
        $infoCell = ChilePhoneHelper::getAreaInfo('987654321');
        $this->assertEquals('9', $infoCell['code']);
        $this->assertTrue($infoCell['is_mobile']);

        $infoStgo = ChilePhoneHelper::getAreaInfo('222345678');
        $this->assertEquals('2', $infoStgo['code']);
        $this->assertEquals('Santiago y Región Metropolitana', $infoStgo['city']);

        $infoValpo = ChilePhoneHelper::getAreaInfo('322123456');
        $this->assertEquals('32', $infoValpo['code']);
        $this->assertStringContainsString('Valparaíso', $infoValpo['city']);
    }

    public function test_formats_numbers_legibly_for_chile(): void
    {
        $this->assertEquals('9 8765 4321', ChilePhoneHelper::format('987654321'));
        $this->assertEquals('2 2234 5678', ChilePhoneHelper::format('222345678'));
        $this->assertEquals('32 212 3456', ChilePhoneHelper::format('322123456'));
        $this->assertEquals('800 123 456', ChilePhoneHelper::format('800123456'));
    }
}
