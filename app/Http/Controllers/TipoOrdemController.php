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
        $tiposOrden = TipoOrdem::create($request->only('nome'));

        return response()->json($tiposOrden, 201);
    }

    public function show(TipoOrdem $tiposOrden)
    {
        return $tiposOrden;
    }

    public function update(UpdateTipoOrdemRequest $request, TipoOrdem $tiposOrden)
    {
        $tiposOrden->update($request->only('nome'));

        return $tiposOrden;
    }

    public function destroy(TipoOrdem $tiposOrden)
    {
        $tiposOrden->delete();

        return response()->json(null, 204);
    }
}
