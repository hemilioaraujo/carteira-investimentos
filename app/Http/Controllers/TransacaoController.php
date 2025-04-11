<?php

namespace App\Http\Controllers;

use App\Models\Transacao;
use Illuminate\Http\Request;

class TransacaoController extends Controller
{
    public function index()
    {
        return Transacao::with(['tipo', 'ativo', 'corretora'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required|date',
            'tipo_id' => 'required|exists:tipos,id',
            'ativo_id' => 'required|exists:ativos,id',
            'quantidade' => 'required|numeric|min:0',
            'preco_unitario' => 'nullable|numeric|min:0',
            'valor_total' => 'required|numeric|min:0',
            'corretora_id' => 'nullable|exists:corretoras,id',
            'observacoes' => 'nullable|string',
        ]);

        $transacao = Transacao::create($request->all());

        return response()->json($transacao->load(['tipo', 'ativo', 'corretora']), 201);
    }

    public function show(Transacao $transacao)
    {
        return $transacao->load(['tipo', 'ativo', 'corretora']);
    }

    public function update(Request $request, Transacao $transacao)
    {
        $request->validate([
            'data' => 'required|date',
            'tipo_id' => 'required|exists:tipos,id',
            'ativo_id' => 'required|exists:ativos,id',
            'quantidade' => 'required|numeric|min:0',
            'preco_unitario' => 'nullable|numeric|min:0',
            'valor_total' => 'required|numeric|min:0',
            'corretora_id' => 'nullable|exists:corretoras,id',
            'observacoes' => 'nullable|string',
        ]);

        $transacao->update($request->all());

        return $transacao->load(['tipo', 'ativo', 'corretora']);
    }

    public function destroy(Transacao $transacao)
    {
        $transacao->delete();

        return response()->json(null, 204);
    }
}
