<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsumosController extends Controller
{
    public function index()
    {
        $insumos = Insumo::all();
        return view('admin.insumos.index', compact('insumos'));
    }
public function show($id)
{
    $insumo = Insumo::findOrFail($id);
    return view('insumos.show', compact('insumo'));
}
       public function store(Request $request)
    {
        $request->validate([
            'nombre_insumo' => 'required',
            'costo_unidad' => 'required|numeric'
        ]);

        Insumo::create([
            'nombre_insumo' => $request->nombre_insumo,
            'costo_unidad' => $request->costo_unidad
        ]);

        return redirect()
            ->route('insumos.index')
            ->with('success', 'Insumo registrado correctamente');
    }

    
}