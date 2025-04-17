<?php

namespace Tests\Unit;

use App\Http\Requests\UpdateCorretoraRequest;
use App\Models\Corretora;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateCorretoraRequestTest extends TestCase
{
    use RefreshDatabase;

    private UpdateCorretoraRequest $request;

    private Corretora $corretora;

    protected function setUp(): void
    {
        parent::setUp();

        $this->corretora = Corretora::factory()->create(['nome' => 'Corretora Teste', 'cnpj' => '00000000000001']);
        $this->request = new class($this->corretora) extends UpdateCorretoraRequest
        {
            public function __construct(public $corretora) {}

            public function route($param = null, $default = null)
            {
                return $param === 'corretora' ? $this->corretora : null;
            }
        };
    }

    public function test_it_validates_valid_data()
    {
        $data = [
            'nome' => 'Corretora Teste',
            'cnpj' => '00000000000100',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->passes());
    }

    public function test_it_fails_when_nome_is_missing()
    {
        $data = [
            'cnpj' => '000000000000001',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('nome', $validator->errors()->toArray());
    }

    public function test_it_fails_when_nome_is_too_long()
    {
        $data = [
            'nome' => Str::random(101),
            'cnpj' => '000000000000001',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('nome', $validator->errors()->toArray());
    }

    public function test_it_fails_when_nome_is_not_unique()
    {
        $nome = 'Nova Corretora';
        Corretora::factory()->create(['nome' => $nome]);

        $data = [
            'nome' => $nome,
            'cnpj' => '000000000000001',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('nome', $validator->errors()->toArray());
    }

    public function test_it_fails_when_cnpj_is_missing()
    {
        $data = [
            'nome' => 'Corretora Teste',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('cnpj', $validator->errors()->toArray());
    }

    public function test_it_fails_when_cnpj_is_too_long()
    {
        $data = [
            'nome' => 'Corretora Teste',
            'cnpj' => Str::random(15),
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('cnpj', $validator->errors()->toArray());
    }

    public function test_it_fails_when_cnpj_is_not_unique()
    {
        $cnpj = '00000000000100';
        Corretora::factory()->create(['cnpj' => $cnpj]);

        $data = [
            'nome' => 'Corretora Teste',
            'cnpj' => $cnpj,
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('cnpj', $validator->errors()->toArray());
    }
}
