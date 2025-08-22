<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ingreso;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    public function index()
    {
        return Ingreso::orderBy('fecha', 'desc')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string',
            'monto' => 'required|numeric',
            'fecha' => 'required|date',
        ]);

        $ingreso = Ingreso::create($validated);

        return response()->json($ingreso, 201);
    }

    public function update(Request $request, Ingreso $ingreso)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string',
            'monto' => 'required|numeric',
            'fecha' => 'required|date',
        ]);

        $ingreso->update($validated);

        return response()->json($ingreso, 200);
    }

    public function destroy(Ingreso $ingreso)
    {
        $ingreso->delete();

        return response()->json(null, 204);
    }
}
