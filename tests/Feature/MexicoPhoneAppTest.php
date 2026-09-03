<?php

namespace Tests\Feature;

use App\Models\Phone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MexicoPhoneAppTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_home_page_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('QuiénLlama');
        $response->assertSee('México');
    }

    public function test_search_redirects_to_phone_profile(): void
    {
        $response = $this->get('/buscar?q=5588982939');
        $response->assertRedirect('/5588982939');
    }

    public function test_phone_page_shows_real_report(): void
    {
        $response = $this->get('/5588982939');
        $response->assertStatus(200);
        $response->assertSee('(55) 8898 2939');
        $response->assertSee('Ciudad de México');
    }

    public function test_area_codes_index_and_show(): void
    {
        $responseIndex = $this->get('/claves-lada');
        $responseIndex->assertStatus(200);
        $responseIndex->assertSee('Claves LADA');

        $responseShow = $this->get('/clave-lada/55');
        $responseShow->assertStatus(200);
        $responseShow->assertSee('55');
    }

    public function test_vcf_and_legal_pages(): void
    {
        $this->get('/bloquear-spam-masivo')->assertStatus(200);
        $this->get('/no-molestar')->assertStatus(200);
        $this->get('/sobre-mi')->assertStatus(200);
        $this->get('/contacto')->assertStatus(200);
        $this->get('/sitemap.xml')->assertStatus(200);
    }
}
