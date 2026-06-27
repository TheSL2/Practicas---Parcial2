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
        if (!$request->user()->tokenCan('crear')) {
            return response()->json(['mensaje' => 'Acción no autorizada. El token no tiene la habilidad: crear'], 403);
        }

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
        if (!$request->user()->tokenCan('editar')) {
            return response()->json(['mensaje' => 'Acción no autorizada. El token no tiene la habilidad: editar'], 403);
        }

        $producto->update($request->all());
        return response()->json($producto, 200);
    }

    public function destroy(Request $request, Producto $producto) {
        if (!$request->user()->tokenCan('eliminar')) {
            return response()->json(['mensaje' => 'Acción no autorizada. El token no tiene la habilidad: eliminar'], 403);
        }

        $producto->delete();
        return response()->json(['mensaje' => 'Eliminado'], 200);
    }
}