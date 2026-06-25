<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return response()->json(Categoria::all(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'slug' => 'required|string|unique:categorias,slug|max:100',
        ]);

        $categoria = Categoria::create($data);
        return response()->json($categoria, 201);
    }

    public function show(Categoria $categoria)
    {
        return response()->json($categoria, 200);
    }

    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'slug' => 'sometimes|required|string|max:100|unique:categorias,slug,' . $categoria->id,
        ]);

        $categoria->update($data);
        return response()->json($categoria, 200);
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return response()->json(['mensaje' => 'Eliminado'], 200);
    }
}