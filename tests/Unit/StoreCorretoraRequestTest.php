<?php

namespace Tests\Unit;

use App\Http\Requests\StoreCorretoraRequest;
use App\Models\Corretora;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreCorretoraRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_validates_valid_data()
    {
        $request = new StoreCorretoraRequest;

        $data = [
            'nome' => 'Corretora Teste',
            'cnpj' => '00000000000100',
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function test_it_fails_when_nome_is_missing()
    {
        $request = new StoreCorretoraRequest;

        $data = [
            'cnpj' => '00000000000100',
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('nome', $validator->errors()->toArray());
    }

    public function test_it_fails_when_nome_is_too_long()
    {
        $request = new StoreCorretoraRequest;

        $data = [
            'nome' => Str::random(101),
            'cnpj' => '00000000000100',
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('nome', $validator->errors()->toArray());
    }

    public function test_it_fails_when_nome_is_not_unique()
    {
        $nome = 'Nova Corretora';
        Corretora::factory()->create(['nome' => $nome]);

        $request = new StoreCorretoraRequest;

        $data = [
            'nome' => $nome,
            'cnpj' => '00000000000100',
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('nome', $validator->errors()->toArray());
    }

    public function test_it_fails_when_cnpj_is_missing()
    {
        $request = new StoreCorretoraRequest;

        $data = [
            'nome' => 'Corretora Teste',
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('cnpj', $validator->errors()->toArray());
    }

    public function test_it_fails_when_cnpj_is_too_long()
    {
        $request = new StoreCorretoraRequest;

        $data = [
            'nome' => 'Corretora Teste',
            'cnpj' => Str::random(15),
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('cnpj', $validator->errors()->toArray());
    }

    public function test_it_fails_when_cnpj_is_not_unique()
    {
        $cnpj = '00000000000100';
        Corretora::factory()->create(['cnpj' => $cnpj]);

        $request = new StoreCorretoraRequest;

        $data = [
            'nome' => 'Corretora Teste',
            'cnpj' => $cnpj,
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('cnpj', $validator->errors()->toArray());
    }
}
