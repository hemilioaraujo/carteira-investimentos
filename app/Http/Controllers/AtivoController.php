<?php

namespace App\Http\Controllers;

use App\Models\Ativo;
use Illuminate\Http\Request;

class AtivoController extends Controller
{
    public function index()
    {
        return Ativo::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:ativos,codigo|max:6',
            'descricao' => 'nullable|string|max:255',
        ]);

        $ativo = Ativo::create($request->only('codigo', 'descricao'));

        return response()->json($ativo, 201);
    }

    public function show(Ativo $ativo)
    {
        return $ativo;
    }

    public function update(Request $request, Ativo $ativo)
    {
        $request->validate([
            'codigo' => 'required|max:6|unique:ativos,codigo,'.$ativo->id,
            'descricao' => 'nullable|string|max:255',
        ]);

        $ativo->update($request->only('codigo', 'descricao'));

        return $ativo;
    }

    public function destroy(Ativo $ativo)
    {
        $ativo->delete();

        return response()->json(null, 204);
    }
}
