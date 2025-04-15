<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAtivoRequest;
use App\Http\Requests\UpdateAtivoRequest;
use App\Models\Ativo;

class AtivoController extends Controller
{
    public function index()
    {
        return Ativo::all();
    }

    public function store(StoreAtivoRequest $request)
    {
        $ativo = Ativo::create($request->only('codigo', 'descricao', 'cnpj'));

        return response()->json($ativo, 201);
    }

    public function show(Ativo $ativo)
    {
        return $ativo;
    }

    public function update(UpdateAtivoRequest $request, Ativo $ativo)
    {
        $ativo->update($request->only('codigo', 'descricao', 'cnpj'));

        return $ativo;
    }

    public function destroy(Ativo $ativo)
    {
        $ativo->delete();

        return response()->json(null, 204);
    }
}
