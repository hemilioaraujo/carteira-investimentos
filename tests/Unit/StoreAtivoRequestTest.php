<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\StoreAtivoRequest;
use App\Models\Ativo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class StoreAtivoRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_validates_valid_data()
    {
        $request = new StoreAtivoRequest;

        $data = [
            'codigo' => 'ITSA4',
            'descricao' => 'Itaúsa S.A.',
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function test_it_fails_when_codigo_is_missing()
    {
        $request = new StoreAtivoRequest;

        $data = [
            'descricao' => 'Faltando código',
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('codigo', $validator->errors()->toArray());
    }

    public function test_it_fails_when_codigo_is_too_long()
    {
        $request = new StoreAtivoRequest;

        $data = [
            'codigo' => 'EXCEDEU',
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('codigo', $validator->errors()->toArray());
    }

    public function test_it_fails_when_codigo_is_not_unique()
    {
        $codigo = 'ITSA4';
        Ativo::factory()->create(['codigo' => $codigo]);

        $request = new StoreAtivoRequest;

        $data = [
            'codigo' => $codigo,
            'descricao' => 'Tentativa duplicada',
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('codigo', $validator->errors()->toArray());
    }

    public function test_it_accepts_null_descricao()
    {
        $request = new StoreAtivoRequest;

        $data = [
            'codigo' => 'PETR4',
            'descricao' => null,
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }
}
