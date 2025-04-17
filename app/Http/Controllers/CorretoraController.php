<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCorretoraRequest;
use App\Http\Requests\UpdateCorretoraRequest;
use App\Models\Corretora;

class CorretoraController extends Controller
{
    public function index()
    {
        return Corretora::all();
    }

    public function store(StoreCorretoraRequest $request)
    {
        $corretora = Corretora::create($request->only('nome', 'cnpj'));

        return response()->json($corretora, 201);
    }

    public function show(Corretora $corretora)
    {
        return $corretora;
    }

    public function update(UpdateCorretoraRequest $request, Corretora $corretora)
    {
        $corretora->update($request->only('nome', 'cnpj'));

        return $corretora;
    }

    public function destroy(Corretora $corretora)
    {
        $corretora->delete();

        return response()->json(null, 204);
    }
}
