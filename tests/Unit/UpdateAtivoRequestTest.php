<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\UpdateAtivoRequest;
use App\Models\Ativo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class UpdateAtivoRequestTest extends TestCase
{
    use RefreshDatabase;

    private UpdateAtivoRequest $request;

    private Ativo $ativo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ativo = Ativo::factory()->create(['codigo' => 'ITSA4', 'descricao' => 'Itaúsa S.A.', 'cnpj' => '00000000000100']);

        $this->request = new class($this->ativo) extends UpdateAtivoRequest
        {
            public function __construct(public $ativo) {}

            public function route($param = null, $default = null)
            {
                return $param === 'ativo' ? $this->ativo : null;
            }
        };
    }

    public function test_it_validates_valid_data()
    {
        $data = [
            'codigo' => 'ITSA4',
            'descricao' => 'Itaúsa S.A.',
            'cnpj' => '00000000000100',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->passes());
    }

    public function test_it_fails_when_codigo_is_missing()
    {
        $data = [
            'descricao' => 'Faltando código',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('codigo', $validator->errors()->toArray());
    }

    public function test_it_fails_when_codigo_is_too_long()
    {
        $data = [
            'codigo' => 'EXCEDEU',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('codigo', $validator->errors()->toArray());
    }

    public function test_it_fails_when_codigo_is_not_unique()
    {
        $codigo = 'COD12';
        Ativo::factory()->create(['codigo' => $codigo]);

        $data = [
            'codigo' => $codigo,
            'descricao' => 'Tentativa duplicada',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('codigo', $validator->errors()->toArray());
    }

    public function test_it_accepts_null_descricao()
    {
        $data = [
            'codigo' => 'PETR4',
            'descricao' => null,
            'cnpj' => '00000000000100',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->passes());
    }

    public function test_it_fails_when_cnpj_is_missing()
    {
        $data = [
            'cnpj' => '',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('cnpj', $validator->errors()->toArray());
    }

    public function test_it_fails_when_cnpj_is_not_unique()
    {
        $cnpj = '10000000000100';
        Ativo::factory()->create(['cnpj' => $cnpj]);

        $data = [
            'cnpj' => $cnpj,
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('cnpj', $validator->errors()->toArray());
    }

    public function test_it_fails_when_cnpj_is_too_long()
    {
        $data = [
            'cnpj' => '000000000001001',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('cnpj', $validator->errors()->toArray());
    }
}
