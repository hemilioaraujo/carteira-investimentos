<?php

namespace Database\Seeders;

use App\Models\Ativo;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Corretora;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $ativo = Ativo::factory()->create(['codigo' => 'ITSA4', 'descricao' => 'Itáu S.A.', 'cnpj' => '12345678901234']);
        $corretora = Corretora::factory()->create(['nome' => 'NuInvest', 'cnpj' => '22345678901234']);
    }
}
