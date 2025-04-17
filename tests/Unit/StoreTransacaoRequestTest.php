<?php

namespace Tests\Unit;

use App\Http\Requests\StoreTransacaoRequest;
use App\Models\Ativo;
use App\Models\Corretora;
use App\Models\TipoOrdem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class StoreTransacaoRequestTest extends TestCase
{
    use RefreshDatabase;

    private TipoOrdem $tipoOrdem;

    private Ativo $ativo;

    private Corretora $corretora;

    private StoreTransacaoRequest $request;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tipoOrdem = TipoOrdem::factory()->create();
        $this->ativo = Ativo::factory()->create();
        $this->corretora = Corretora::factory()->create();
        $this->request = new StoreTransacaoRequest;
    }

    public function test_it_validates_valid_data()
    {
        $data = [
            'tipo_ordem_id' => $this->tipoOrdem->id,
            'ativo_id' => $this->ativo->id,
            'corretora_id' => $this->corretora->id,
            'data' => '2022-01-01',
            'quantidade' => 10,
            'preco_unitario' => 100,
            'valor_total' => 1000,
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->passes());
    }

    public function test_it_fails_when_data_is_missing()
    {
        $data = [
            'tipo_ordem_id' => $this->tipoOrdem->id,
            'ativo_id' => $this->ativo->id,
            'corretora_id' => $this->corretora->id,
            'quantidade' => 10,
            'preco_unitario' => 100,
            'valor_total' => 1000,
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('data', $validator->errors()->toArray());
    }

    public function test_it_fails_when_data_has_invalid_format()
    {
        $data = [
            'tipo_ordem_id' => $this->tipoOrdem->id,
            'ativo_id' => $this->ativo->id,
            'corretora_id' => $this->corretora->id,
            'data' => 'invalid-date',
            'quantidade' => 10,
            'preco_unitario' => 100,
            'valor_total' => 1000,
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('data', $validator->errors()->toArray());
    }

    public function test_it_fails_when_tipo_ordem_id_is_missing()
    {
        $data = [
            'data' => '2022-01-01',
            'ativo_id' => $this->ativo->id,
            'corretora_id' => $this->corretora->id,
            'quantidade' => 10,
            'preco_unitario' => 100,
            'valor_total' => 1000,
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('tipo_ordem_id', $validator->errors()->toArray());
    }

    public function test_it_fails_when_tipo_ordem_id_not_exists()
    {
        $data = [
            'data' => '2022-01-01',
            'tipo_ordem_id' => $this->tipoOrdem->id + 99,
            'ativo_id' => $this->ativo->id,
            'corretora_id' => $this->corretora->id,
            'quantidade' => 10,
            'preco_unitario' => 100,
            'valor_total' => 1000,
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('tipo_ordem_id', $validator->errors()->toArray());
    }

    public function test_it_fails_when_ativo_id_is_missing()
    {
        $data = [
            'data' => '2022-01-01',
            'tipo_ordem_id' => $this->tipoOrdem->id,
            'corretora_id' => $this->corretora->id,
            'quantidade' => 10,
            'preco_unitario' => 100,
            'valor_total' => 1000,
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('ativo_id', $validator->errors()->toArray());
    }

    public function test_it_fails_when_ativo_id_not_exists()
    {
        $data = [
            'data' => '2022-01-01',
            'tipo_ordem_id' => $this->tipoOrdem->id,
            'ativo_id' => $this->ativo->id + 99,
            'corretora_id' => $this->corretora->id,
            'quantidade' => 10,
            'preco_unitario' => 100,
            'valor_total' => 1000,
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('ativo_id', $validator->errors()->toArray());
    }

    public function test_it_fails_when_corretora_id_is_missing()
    {
        $data = [
            'data' => '2022-01-01',
            'tipo_ordem_id' => $this->tipoOrdem->id,
            'ativo_id' => $this->ativo->id,
            'quantidade' => 10,
            'preco_unitario' => 100,
            'valor_total' => 1000,
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('corretora_id', $validator->errors()->toArray());
    }

    public function test_it_fails_when_corretora_id_not_exists()
    {
        $data = [
            'data' => '2022-01-01',
            'tipo_ordem_id' => $this->tipoOrdem->id,
            'ativo_id' => $this->ativo->id,
            'corretora_id' => $this->corretora->id + 99,
            'quantidade' => 10,
            'preco_unitario' => 100,
            'valor_total' => 1000,
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('corretora_id', $validator->errors()->toArray());
    }

    public function test_it_fails_when_quantidade_is_missing()
    {
        $data = [
            'data' => '2022-01-01',
            'tipo_ordem_id' => $this->tipoOrdem->id,
            'ativo_id' => $this->ativo->id,
            'corretora_id' => $this->corretora->id,
            'preco_unitario' => 100,
            'valor_total' => 1000,
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('quantidade', $validator->errors()->toArray());
    }

    public function test_it_fails_when_quantidade_is_not_numeric()
    {
        $data = [
            'data' => '2022-01-01',
            'tipo_ordem_id' => $this->tipoOrdem->id,
            'ativo_id' => $this->ativo->id,
            'corretora_id' => $this->corretora->id,
            'quantidade' => 'quantidade',
            'preco_unitario' => 100,
            'valor_total' => 1000,
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('quantidade', $validator->errors()->toArray());
    }

    public function test_it_fails_when_quantidade_is_less_than_0()
    {
        $data = [
            'data' => '2022-01-01',
            'tipo_ordem_id' => $this->tipoOrdem->id,
            'ativo_id' => $this->ativo->id,
            'corretora_id' => $this->corretora->id,
            'quantidade' => -0.1,
            'preco_unitario' => 100,
            'valor_total' => 1000,
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('quantidade', $validator->errors()->toArray());
    }

    public function test_it_fails_when_preco_unitario_is_missing()
    {
        $data = [
            'data' => '2022-01-01',
            'tipo_ordem_id' => $this->tipoOrdem->id,
            'ativo_id' => $this->ativo->id,
            'corretora_id' => $this->corretora->id,
            'quantidade' => 10,
            'valor_total' => 1000,
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('preco_unitario', $validator->errors()->toArray());
    }

    public function test_it_fails_when_preco_unitario_is_not_numeric()
    {
        $data = [
            'data' => '2022-01-01',
            'tipo_ordem_id' => $this->tipoOrdem->id,
            'ativo_id' => $this->ativo->id,
            'corretora_id' => $this->corretora->id,
            'quantidade' => 10,
            'preco_unitario' => 'preco_unitario',
            'valor_total' => 1000,
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('preco_unitario', $validator->errors()->toArray());
    }

    public function test_it_fails_when_preco_unitario_is_less_than_0()
    {
        $data = [
            'data' => '2022-01-01',
            'tipo_ordem_id' => $this->tipoOrdem->id,
            'ativo_id' => $this->ativo->id,
            'corretora_id' => $this->corretora->id,
            'quantidade' => 10,
            'preco_unitario' => -0.1,
            'valor_total' => 1000,
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('preco_unitario', $validator->errors()->toArray());
    }

    public function test_it_fails_when_valor_total_is_missing()
    {
        $data = [
            'data' => '2022-01-01',
            'tipo_ordem_id' => $this->tipoOrdem->id,
            'ativo_id' => $this->ativo->id,
            'corretora_id' => $this->corretora->id,
            'quantidade' => 10,
            'preco_unitario' => 100,
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('valor_total', $validator->errors()->toArray());
    }

    public function test_it_fails_when_valor_total_is_not_numeric()
    {
        $data = [
            'data' => '2022-01-01',
            'tipo_ordem_id' => $this->tipoOrdem->id,
            'ativo_id' => $this->ativo->id,
            'corretora_id' => $this->corretora->id,
            'quantidade' => 10,
            'preco_unitario' => 100,
            'valor_total' => 'valor_total',
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('valor_total', $validator->errors()->toArray());
    }

    public function test_it_fails_when_valor_total_is_less_than_0()
    {
        $data = [
            'data' => '2022-01-01',
            'tipo_ordem_id' => $this->tipoOrdem->id,
            'ativo_id' => $this->ativo->id,
            'corretora_id' => $this->corretora->id,
            'quantidade' => 10,
            'preco_unitario' => 100,
            'valor_total' => -0.1,
            'observacoes' => 'Observações da transação',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('valor_total', $validator->errors()->toArray());
    }
}
