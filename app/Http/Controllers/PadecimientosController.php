<?php

namespace App\Http\Controllers;

use App\Models\Padecimiento;
use Illuminate\Http\Request;

class PadecimientosController extends Controller
{
    public function index()
    {
        $padecimientos = Padecimiento::all();
        return view('admin.padecimientos.index', compact('padecimientos'));
    }

    public function create()
    {
        return view('admin.padecimientos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_padecimiento' => 'required|string|max:255',
            'nivel_riesgo'        => 'nullable|string|max:100',
            'costo_extra'         => 'nullable|numeric|min:0',
        ]);

        Padecimiento::create($request->only(['nombre_padecimiento', 'nivel_riesgo', 'costo_extra']));

        return redirect()->route('padecimientos.index')
            ->with('success', 'Padecimiento registrado correctamente.');
    }

    public function edit($id)
    {
        $padecimiento = Padecimiento::findOrFail($id);
        return view('admin.padecimientos.edit', compact('padecimiento'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_padecimiento' => 'required|string|max:255',
            'nivel_riesgo'        => 'nullable|string|max:100',
            'costo_extra'         => 'nullable|numeric|min:0',
        ]);

        $padecimiento = Padecimiento::findOrFail($id);
        $padecimiento->update($request->only(['nombre_padecimiento', 'nivel_riesgo', 'costo_extra']));

        return redirect()->route('padecimientos.index')
            ->with('success', 'Padecimiento actualizado correctamente.');
    }

    public function delete($id)
    {
        $padecimiento = Padecimiento::findOrFail($id);
        $padecimiento->delete();

        return redirect()->route('padecimientos.index')
            ->with('success', 'Padecimiento eliminado correctamente.');
    }
}
