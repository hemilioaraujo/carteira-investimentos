<?php

namespace Tests\Feature;

use App\Models\Corretora;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CorretoraControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_return_corretoras()
    {
        Corretora::factory(2)->create();

        $response = $this->getJson(route('corretoras.index'));

        $response->assertOk();
        $response->assertJsonCount(2);
    }

    public function test_store_create_corretora()
    {
        $response = $this->postJson(route('corretoras.store'), [
            'nome' => 'Teste',
            'cnpj' => '12345678901234',
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('corretoras', [
            'nome' => 'Teste',
            'cnpj' => '12345678901234',
        ]);
    }

    public function test_show_return_corretora()
    {
        $corretora = Corretora::factory()->create();

        $response = $this->getJson(route('corretoras.show', $corretora));

        $response->assertOk();
        $response->assertJson($corretora->toArray());
    }

    public function test_show_return_not_found()
    {
        $response = $this->getJson(route('corretoras.show', 0));

        $response->assertNotFound();
    }

    public function test_update_update_corretora()
    {
        $corretora = Corretora::factory()->create();

        $response = $this->putJson(route('corretoras.update', $corretora), [
            'nome' => 'Teste',
            'cnpj' => '12345678901234',
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('corretoras', [
            'id' => $corretora->id,
            'nome' => 'Teste',
            'cnpj' => '12345678901234',
        ]);
    }

    public function test_update_return_not_found()
    {
        $response = $this->putJson(route('corretoras.update', 0), [
            'nome' => 'Teste',
            'cnpj' => '12345678901234',
        ]);

        $response->assertNotFound();
    }

    public function test_destroy_delete_corretora()
    {
        $corretora = Corretora::factory()->create();

        $response = $this->deleteJson(route('corretoras.destroy', $corretora));

        $response->assertNoContent();
        $this->assertDatabaseMissing('corretoras', [
            'id' => $corretora->id,
        ]);
    }
}
