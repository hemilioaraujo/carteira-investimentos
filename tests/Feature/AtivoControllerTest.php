<?php

namespace Tests\Feature;

use App\Models\Ativo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AtivoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_return_ativos()
    {
        Ativo::factory(3)->create();

        $response = $this->getJson(route('ativos.index'));

        $response->assertOk();
        $response->assertJsonCount(3);
    }

    public function test_store_create_ativo()
    {
        $response = $this->postJson(route('ativos.store'), [
            'codigo' => 'TESTE',
            'descricao' => 'Teste',
            'cnpj' => '12345678901234',
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('ativos', [
            'codigo' => 'TESTE',
            'descricao' => 'Teste',
            'cnpj' => '12345678901234',
        ]);
    }

    public function test_show_return_ativo()
    {
        $ativo = Ativo::factory()->create();

        $response = $this->getJson(route('ativos.show', $ativo));

        $response->assertOk();
        $response->assertJson($ativo->toArray());
    }

    public function test_show_return_not_found()
    {
        $response = $this->getJson(route('ativos.show', 0));

        $response->assertNotFound();
    }

    public function test_update_update_ativo()
    {
        $ativo = Ativo::factory()->create();

        $response = $this->putJson(route('ativos.update', $ativo), [
            'codigo' => 'TESTE',
            'descricao' => 'Teste',
            'cnpj' => '12345678901234',
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('ativos', [
            'id' => $ativo->id,
            'codigo' => 'TESTE',
            'descricao' => 'Teste',
            'cnpj' => '12345678901234',
        ]);
    }

    public function test_update_return_not_found()
    {
        $response = $this->putJson(route('ativos.update', 0), [
            'codigo' => 'TESTE',
            'descricao' => 'Teste',
            'cnpj' => '12345678901234',
        ]);

        $response->assertNotFound();
    }

    public function test_destroy_delete_ativo()
    {
        $ativo = Ativo::factory()->create();

        $response = $this->deleteJson(route('ativos.destroy', $ativo));

        $response->assertNoContent();
        $this->assertDatabaseMissing('ativos', [
            'id' => $ativo->id,
        ]);
    }
}
