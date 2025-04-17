<?php

namespace Tests\Unit;

use App\Http\Requests\StoreTipoOrdemRequest;
use App\Models\TipoOrdem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreTipoOrdemRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_validates_valid_data()
    {
        $request = new StoreTipoOrdemRequest;

        $data = [
            'nome' => 'Ordem Teste',
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function test_it_fails_when_nome_is_missing()
    {
        $request = new StoreTipoOrdemRequest;

        $data = [];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('nome', $validator->errors()->toArray());
    }

    public function test_it_fails_when_nome_is_too_long()
    {
        $request = new StoreTipoOrdemRequest;

        $data = [
            'nome' => Str::random(101),
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('nome', $validator->errors()->toArray());
    }

    public function test_it_fails_when_nome_is_not_unique()
    {
        $nome = 'Ordem Teste';
        TipoOrdem::factory()->create(['nome' => $nome]);

        $request = new StoreTipoOrdemRequest;

        $data = [
            'nome' => $nome,
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('nome', $validator->errors()->toArray());
    }
}
