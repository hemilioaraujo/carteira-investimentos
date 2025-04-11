<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    public function index()
    {
        return Tipo::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100|unique:tipos,nome',
        ]);

        $tipo = Tipo::create($request->only('nome'));

        return response()->json($tipo, 201);
    }

    public function show(Tipo $tipo)
    {
        return $tipo;
    }

    public function update(Request $request, Tipo $tipo)
    {
        $request->validate([
            'nome' => 'required|string|max:100|unique:tipos,nome,'.$tipo->id,
        ]);

        $tipo->update($request->only('nome'));

        return $tipo;
    }

    public function destroy(Tipo $tipo)
    {
        $tipo->delete();

        return response()->json(null, 204);
    }
}
