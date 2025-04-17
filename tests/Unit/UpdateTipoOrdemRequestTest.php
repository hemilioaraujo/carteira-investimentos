<?php

namespace Tests\Unit;

use App\Http\Requests\UpdateTipoOrdemRequest;
use App\Models\TipoOrdem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateTipoOrdemRequestTest extends TestCase
{
    use RefreshDatabase;

    private UpdateTipoOrdemRequest $request;

    private TipoOrdem $tipoOrdem;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tipoOrdem = TipoOrdem::factory()->create(['nome' => 'Tipo Ordem Teste']);
        $this->request = new class($this->tipoOrdem) extends UpdateTipoOrdemRequest
        {
            public function __construct(public $tipoOrdem) {}

            public function route($param = null, $default = null)
            {
                return $param === 'tiposOrden' ? $this->tipoOrdem : null;
            }
        };
    }

    public function test_it_validates_valid_data()
    {
        $data = [
            'nome' => 'Tipo Ordem Teste',
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->passes());
    }

    public function test_it_fails_when_nome_is_missing()
    {
        $data = [];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('nome', $validator->errors()->toArray());
    }

    public function test_it_fails_when_nome_is_too_long()
    {
        $data = [
            'nome' => Str::random(101),
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('nome', $validator->errors()->toArray());
    }

    public function test_it_fails_when_nome_is_not_unique()
    {
        $nome = 'Ordem Teste';
        TipoOrdem::factory()->create(['nome' => $nome]);

        $data = [
            'nome' => $nome,
        ];

        $validator = Validator::make($data, $this->request->rules());

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('nome', $validator->errors()->toArray());
    }
}
