<?php

namespace Database\Factories;

use App\Models\Ativo;
use App\Models\Corretora;
use App\Models\TipoOrdem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transacao>
 */
class TransacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo_ordem_id' => TipoOrdem::factory(),
            'corretora_id' => Corretora::factory(),
            'ativo_id' => Ativo::factory(),
            'quantidade' => $quantidade = $this->faker->randomNumber(3),
            'preco_unitario' => $precoUnitario = $this->faker->randomFloat(2, 0, 100),
            'valor_total' => round($quantidade * $precoUnitario, 2),
            'data' => $this->faker->date(),
            'observacoes' => $this->faker->sentence(),
        ];
    }
}
