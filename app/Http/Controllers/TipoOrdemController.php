<?php

namespace App\Http\Controllers;

use App\Models\TipoOrdem;
use Illuminate\Http\Request;

class TipoOrdemController extends Controller
{
    public function index()
    {
        return TipoOrdem::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100|unique:tipos_ordens,nome',
        ]);

        $tiposOrden = TipoOrdem::create($request->only('nome'));

        return response()->json($tiposOrden, 201);
    }

    public function show(TipoOrdem $tiposOrden)
    {
        return $tiposOrden;
    }

    public function update(Request $request, TipoOrdem $tiposOrden)
    {
        $request->validate([
            'nome' => 'required|string|max:100|unique:tipos_ordens,nome,'.$tiposOrden->id,
        ]);

        $tiposOrden->update($request->only('nome'));

        return $tiposOrden;
    }

    public function destroy(TipoOrdem $tiposOrden)
    {
        $tiposOrden->delete();

        return response()->json(null, 204);
    }
}
