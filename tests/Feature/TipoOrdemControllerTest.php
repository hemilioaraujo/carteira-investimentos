<?php

namespace Tests\Feature;

use App\Models\TipoOrdem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TipoOrdemControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_return_tipos_ordem()
    {
        TipoOrdem::factory(3)->create();

        $response = $this->getJson(route('tipos-ordens.index'));

        $response->assertOk();
        $response->assertJsonCount(3);
    }

    public function test_store_create_tipo_ordem()
    {
        $response = $this->postJson(route('tipos-ordens.store'), [
            'nome' => 'Teste',
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('tipos_ordens', [
            'nome' => 'Teste',
        ]);
    }

    public function test_show_return_tipo_ordem()
    {
        $tipoOrdem = TipoOrdem::factory()->create();

        $response = $this->getJson(route('tipos-ordens.show', $tipoOrdem));

        $response->assertOk();
        $response->assertJson($tipoOrdem->toArray());
    }

    public function test_show_return_not_found()
    {
        $response = $this->getJson(route('tipos-ordens.show', 0));

        $response->assertNotFound();
    }

    public function test_update_update_tipo_ordem()
    {
        $tipoOrdem = TipoOrdem::factory()->create();

        $response = $this->putJson(route('tipos-ordens.update', $tipoOrdem), [
            'nome' => 'Teste',
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('tipos_ordens', [
            'id' => $tipoOrdem->id,
            'nome' => 'Teste',
        ]);
    }

    public function test_update_return_not_found()
    {
        $response = $this->putJson(route('tipos-ordens.update', 0), [
            'nome' => 'Teste',
        ]);

        $response->assertNotFound();
    }

    public function test_destroy_delete_tipo_ordem()
    {
        $tipoOrdem = TipoOrdem::factory()->create();

        $response = $this->deleteJson(route('tipos-ordens.destroy', $tipoOrdem));

        $response->assertNoContent();
        $this->assertDatabaseMissing('tipos_ordens', [
            'id' => $tipoOrdem->id,
        ]);
    }
}
