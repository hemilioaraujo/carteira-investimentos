<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransacaoRequest;
use App\Http\Requests\UpdateTransacaoRequest;
use App\Models\Transacao;

class TransacaoController extends Controller
{
    public function index()
    {
        return Transacao::with(['tipoOrdem', 'ativo', 'corretora'])->get();
    }

    public function store(StoreTransacaoRequest $request)
    {
        $transacao = Transacao::create($request->all());

        return response()->json($transacao->load(['tipoOrdem', 'ativo', 'corretora']), 201);
    }

    public function show(Transacao $transacao)
    {
        return $transacao->load(['tipoOrdem', 'ativo', 'corretora']);
    }

    public function update(UpdateTransacaoRequest $request, Transacao $transacao)
    {
        $transacao->update($request->all());

        return $transacao->load(['tipoOrdem', 'ativo', 'corretora']);
    }

    public function destroy(Transacao $transacao)
    {
        $transacao->delete();

        return response()->json(null, 204);
    }
}
