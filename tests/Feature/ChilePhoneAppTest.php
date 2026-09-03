<?php

namespace Tests\Feature;

use App\Models\Phone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChilePhoneAppTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads_successfully(): void
    {
        Phone::create([
            'number' => '987654321',
            'area_code' => '9',
            'location' => 'Chile (Red Celular Móvil)',
            'spam_score' => 85,
            'views' => 120,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('QuiénLlama');
        $response->assertSee('9 8765 4321');
        $response->assertSee('SERNAC «No Molestar»');
        $response->assertSee('Víctor Alonso');
    }

    public function test_phone_page_shows_number_details_and_dialing_instructions(): void
    {
        $phone = Phone::create([
            'number' => '222345678',
            'area_code' => '2',
            'location' => 'Santiago y Región Metropolitana',
            'spam_score' => 60,
            'views' => 45,
        ]);

        $response = $this->get("/{$phone->number}");

        $response->assertStatus(200);
        $response->assertSee('2 2234 5678');
        $response->assertSee('Santiago y Región Metropolitana');
        $response->assertSee('Marcación Nacional Directa');
        $response->assertSee('+56 222345678');
        $response->assertSee('FAQPage');
        $response->assertSee('Víctor Alonso');
    }

    public function test_search_auto_discovers_new_chilean_number(): void
    {
        $newNumber = '912345678';
        $this->assertDatabaseMissing('phones', ['number' => $newNumber]);

        $response = $this->get("/buscar?q=+56 9 1234 5678");

        $response->assertRedirect("/{$newNumber}");
        $this->assertDatabaseHas('phones', [
            'number' => $newNumber,
            'area_code' => '9',
        ]);
        $this->assertDatabaseHas('searches', [
            'number' => $newNumber,
            'is_new' => true,
        ]);
    }

    public function test_user_can_submit_comment_and_it_increases_spam_score(): void
    {
        $phone = Phone::create([
            'number' => '944556677',
            'area_code' => '9',
            'spam_score' => 20,
        ]);

        $response = $this->post("/numero/{$phone->number}/comentar", [
            'author_name' => 'Usuario Chileno',
            'reason' => 'Estafa / Phishing',
            'content' => 'Me llamaron diciendo que eran de BancoEstado y pedían claves de CuentaRUT.',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('comments', [
            'phone_id' => $phone->id,
            'reason' => 'Estafa / Phishing',
            'author_name' => 'Usuario Chileno',
        ]);

        $phone->refresh();
        $this->assertGreaterThan(20, $phone->spam_score);
    }

    public function test_user_can_download_vcf(): void
    {
        $phone = Phone::create([
            'number' => '955307700',
            'area_code' => '9',
            'spam_score' => 30,
        ]);

        $response = $this->get("/numero/{$phone->number}/vcf");

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/vcard; charset=utf-8');
        $response->assertSee('BEGIN:VCARD');
        $response->assertSee('+56955307700');
        $response->assertSee('END:VCARD');
    }

    public function test_legal_no_molestar_sernac_guide_loads(): void
    {
        $response = $this->get('/no-molestar');

        $response->assertStatus(200);
        $response->assertSee('SERNAC');
        $response->assertSee('No Molestar');
        $response->assertSee('Ley N° 19.496');
        $response->assertSee('sernac.cl');
    }

    public function test_legal_no_llame_redirects_to_no_molestar(): void
    {
        $response = $this->get('/registro-no-llame');
        $response->assertRedirect('/no-molestar');
        $response->assertStatus(301);
    }

    public function test_vcf_bulk_page_loads(): void
    {
        $response = $this->get('/bloquear-spam-masivo');

        $response->assertStatus(200);
        $response->assertSee('Bloqueador Masivo de Spam Telefónico en Chile');
        $response->assertSee('Top 50');
        $response->assertSee('Top 100');
        $response->assertSee('Top 500');
    }

    public function test_vcf_bulk_download_generates_valid_vcard_bundle(): void
    {
        Phone::create(['number' => '988880001', 'area_code' => '9', 'spam_score' => 10]);
        Phone::create(['number' => '988880002', 'area_code' => '9', 'spam_score' => 20]);

        $response = $this->get('/vcf/descargar/top50');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/vcard; charset=utf-8');
        $response->assertSee('BEGIN:VCARD');
        $response->assertSee('+56988880002');
        $response->assertSee('+56988880001');
        $response->assertSee('END:VCARD');
    }

    public function test_prefijos_directory_index_loads(): void
    {
        $response = $this->get('/prefijos');

        $response->assertStatus(200);
        $response->assertSee('Directorio de Prefijos y Códigos de Área de Chile');
        $response->assertSee('Santiago');
        $response->assertSee('Valparaíso');
        $response->assertSee('+56 2');
        $response->assertSee('+56 32');
    }

    public function test_prefijo_detail_page_loads(): void
    {
        $response = $this->get('/prefijo/32');

        $response->assertStatus(200);
        $response->assertSee('Prefijo');
        $response->assertSee('Valparaíso');
        $response->assertSee('+56 32');
    }

    public function test_legacy_caracteristicas_redirects_to_prefijos(): void
    {
        $response = $this->get('/caracteristicas');
        $response->assertRedirect('/prefijos');
        $response->assertStatus(301);

        $response = $this->get('/codigos-de-area');
        $response->assertRedirect('/prefijos');
        $response->assertStatus(301);
    }

    public function test_sitemap_xml_generates_valid_structure(): void
    {
        Phone::create(['number' => '987654321', 'area_code' => '9', 'spam_score' => 10]);

        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
        $response->assertSee('<?xml version="1.0" encoding="UTF-8"?>', false);
        $response->assertSee('/prefijos');
        $response->assertSee('/no-molestar');
        $response->assertSee('/987654321');
    }

    public function test_admin_metrics_panel_forbidden_for_unauthorized_ip(): void
    {
        $response = $this->withServerVariables(['REMOTE_ADDR' => '1.2.3.4'])
            ->get('/panel-metricas');

        $response->assertStatus(403);
    }

    public function test_admin_metrics_panel_allowed_for_admin_ip(): void
    {
        $response = $this->withServerVariables(['REMOTE_ADDR' => '81.202.45.23'])
            ->get('/panel-metricas');

        $response->assertStatus(200);
        $response->assertSee('Panel de Métricas y Telemetría');
    }

    public function test_telemetry_event_can_be_tracked_via_api(): void
    {
        $response = $this->postJson('/api/track', [
            'event_name' => 'vcf_download_click',
            'event_category' => 'conversion',
            'event_label' => 'top100',
            'page_url' => 'https://cl.quienllama.com.es/bloquear-spam-masivo',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['status' => 'ok']);

        $this->assertDatabaseHas('analytics_events', [
            'event_type' => 'vcf_download_click',
            'event_label' => 'top100',
        ]);
    }
}
