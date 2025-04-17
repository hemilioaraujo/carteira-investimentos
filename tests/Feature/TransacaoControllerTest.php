<?php

namespace Tests\Feature;

use App\Models\Ativo;
use App\Models\Corretora;
use App\Models\TipoOrdem;
use App\Models\Transacao;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransacaoControllerTest extends TestCase
{
    use RefreshDatabase;

    private Ativo $ativo;

    private Corretora $corretora;

    private TipoOrdem $tipoOrdem;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ativo = Ativo::factory()->create();
        $this->corretora = Corretora::factory()->create();
        $this->tipoOrdem = TipoOrdem::factory()->create();
    }

    public function test_index_return_transacoes()
    {
        Transacao::factory(3)->create();

        $response = $this->getJson(route('transacoes.index'));

        $response->assertOk();
        $response->assertJsonCount(3);
    }

    public function test_store_create_transacao()
    {
        $data = [
            'data' => now()->format('Y-m-d'),
            'tipo_ordem_id' => $this->tipoOrdem->id,
            'ativo_id' => $this->ativo->id,
            'corretora_id' => $this->corretora->id,
            'quantidade' => 10,
            'preco_unitario' => 100,
            'valor_total' => 1000,
            'observacoes' => 'Observações da transação',
        ];

        $response = $this->postJson(route('transacoes.store'), $data);

        $response->assertCreated();
        $this->assertDatabaseHas('transacoes', $data);
    }

    public function test_show_return_transacao()
    {
        $transacao = Transacao::factory()->create();

        $response = $this->getJson(route('transacoes.show', $transacao));

        $response->assertOk();
        $response->assertJson($transacao->toArray());
    }

    public function test_show_return_not_found()
    {
        $response = $this->getJson(route('transacoes.show', 0));

        $response->assertNotFound();
    }

    public function test_update_update_transacao()
    {
        $transacao = Transacao::factory()->create();

        $data = [
            'data' => $transacao->data,
            'tipo_ordem_id' => $transacao->tipoOrdem->id,
            'ativo_id' => $transacao->ativo->id,
            'corretora_id' => $transacao->corretora->id,
            'quantidade' => $transacao->quantidade,
            'preco_unitario' => $transacao->preco_unitario,
            'valor_total' => $transacao->valor_total,
        ];

        $response = $this->putJson(
            route('transacoes.update', $transacao),
            $newData = [...$data, 'observacoes' => 'Observações atualizadas']
        );

        $response->assertOk();
        $this->assertDatabaseHas('transacoes', $newData);
    }

    public function test_update_return_not_found()
    {
        $response = $this->putJson(route('transacoes.update', 0), []);

        $response->assertNotFound();
    }

    public function test_destroy_delete_transacao()
    {
        $transacao = Transacao::factory()->create();

        $response = $this->deleteJson(route('transacoes.destroy', $transacao));

        $response->assertNoContent();
        $this->assertDatabaseMissing('transacoes', [
            'id' => $transacao->id,
        ]);
    }
}
