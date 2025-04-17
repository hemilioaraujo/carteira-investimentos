<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoOrdemRequest;
use App\Http\Requests\UpdateTipoOrdemRequest;
use App\Models\TipoOrdem;

class TipoOrdemController extends Controller
{
    public function index()
    {
        return TipoOrdem::all();
    }

    public function store(StoreTipoOrdemRequest $request)
    {
        $tipoOrdem = TipoOrdem::create($request->only('nome'));

        return response()->json($tipoOrdem, 201);
    }

    public function show(TipoOrdem $tipoOrdem)
    {
        return $tipoOrdem;
    }

    public function update(UpdateTipoOrdemRequest $request, TipoOrdem $tipoOrdem)
    {
        $tipoOrdem->update($request->only('nome'));

        return $tipoOrdem;
    }

    public function destroy(TipoOrdem $tipoOrdem)
    {
        $tipoOrdem->delete();

        return response()->json(null, 204);
    }
}
