<?php

namespace App\Http\Controllers;

use App\Models\Transacao;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function index()
    {
        $relatorios = Transacao::select(
            'ativo_id',
            'corretora_id',
            DB::raw('sum(quantidade) as quantidade'),
            DB::raw('sum(valor_total) as custo_total_aquisicao'),
            DB::raw('sum(valor_total)/sum(quantidade) as preco_medio')
        )
            ->with(['ativo', 'corretora'])
            ->where('tipo_ordem_id', 1)
            ->groupBy('ativo_id')
            ->get();

        return response(['relatorios' => $relatorios], 200);
    }
}
