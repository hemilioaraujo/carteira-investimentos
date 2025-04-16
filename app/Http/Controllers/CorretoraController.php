<?php

namespace App\Http\Controllers;

use App\Models\Corretora;
use Illuminate\Http\Request;

class CorretoraController extends Controller
{
    public function index()
    {
        return Corretora::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100|unique:corretoras,nome',
            'cnpj' => 'required|string|max:14|unique:corretoras,cnpj',
        ]);

        $corretora = Corretora::create($request->only('nome', 'cnpj'));

        return response()->json($corretora, 201);
    }

    public function show(Corretora $corretora)
    {
        return $corretora;
    }

    public function update(Request $request, Corretora $corretora)
    {
        $request->validate([
            'nome' => 'required|string|max:100|unique:corretoras,nome,'.$corretora->id,
            'cnpj' => 'required|string|max:14|unique:corretoras,cnpj,'.$corretora->id,
        ]);

        $corretora->update($request->only('nome', 'cnpj'));

        return $corretora;
    }

    public function destroy(Corretora $corretora)
    {
        $corretora->delete();

        return response()->json(null, 204);
    }
}
