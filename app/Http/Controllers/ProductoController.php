<?php

namespace App\Http\Controllers; 

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index() {
        return response()->json(Producto::all(), 200);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nombre' => 'required|string|max:150',
            'precio' => 'required|numeric|min:0',
            'stock' => 'integer|min:0',
        ]);

        $producto = Producto::create($data);
        return response()->json($producto, 201);
    }

    public function show(Producto $producto) {
        return response()->json($producto, 200);
    }

    public function update(Request $request, Producto $producto) {
        $producto->update($request->all());
        return response()->json($producto, 200);
    }

    public function destroy(Producto $producto) {
        $producto->delete();
        return response()->json(['mensaje' => 'Eliminado'], 200);
    }
}