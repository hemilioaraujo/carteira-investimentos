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
        $transaco = Transacao::create($request->all());

        return response()->json($transaco->load(['tipoOrdem', 'ativo', 'corretora']), 201);
    }

    public function show(Transacao $transaco)
    {
        return $transaco->load(['tipoOrdem', 'ativo', 'corretora']);
    }

    public function update(UpdateTransacaoRequest $request, Transacao $transaco)
    {
        $transaco->update($request->all());

        return $transaco->load(['tipoOrdem', 'ativo', 'corretora']);
    }

    public function destroy(Transacao $transaco)
    {
        $transaco->delete();

        return response()->json(null, 204);
    }
}
