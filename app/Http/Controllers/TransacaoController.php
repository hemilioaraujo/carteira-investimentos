<?php

namespace App\Http\Controllers;

use App\Models\Transacao;
use Illuminate\Http\Request;

class TransacaoController extends Controller
{
    public function index()
    {
        return Transacao::with(['tipoOrdem', 'ativo', 'corretora'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required|date',
            'tipo_ordem_id' => 'required|exists:tipos_ordens,id',
            'ativo_id' => 'required|exists:ativos,id',
            'quantidade' => 'required|numeric|min:0',
            'preco_unitario' => 'nullable|numeric|min:0',
            'valor_total' => 'required|numeric|min:0',
            'corretora_id' => 'nullable|exists:corretoras,id',
            'observacoes' => 'nullable|string',
        ]);

        $transaco = Transacao::create($request->all());

        return response()->json($transaco->load(['tipoOrdem', 'ativo', 'corretora']), 201);
    }

    public function show(Transacao $transaco)
    {
        return $transaco->load(['tipoOrdem', 'ativo', 'corretora']);
    }

    public function update(Request $request, Transacao $transaco)
    {

        $request->validate([
            'data' => 'required|date',
            'tipo_ordem_id' => 'required|exists:tipos_ordens,id',
            'ativo_id' => 'required|exists:ativos,id',
            'quantidade' => 'required|numeric|min:0',
            'preco_unitario' => 'nullable|numeric|min:0',
            'valor_total' => 'required|numeric|min:0',
            'corretora_id' => 'nullable|exists:corretoras,id',
            'observacoes' => 'nullable|string',
        ]);

        $transaco->update($request->all());

        return $transaco->load(['tipoOrdem', 'ativo', 'corretora']);
    }

    public function destroy(Transacao $transaco)
    {
        $transaco->delete();

        return response()->json(null, 204);
    }
}
