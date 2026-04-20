<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\Ambulancia;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
   public function index(Request $request)
    {
        $query = Servicio::query();

        if ($request->filled('tipo')) { //cambia 'tipo'
            $query->where('tipo', $request->tipo); // los 'tipo' se cambian
        }

        $servicio = $query->get();

        $tipos = [ //se puede cambiar
            'Traslado' => 'Traslado',
            'Evento' => 'Evento',
            'Otro' => 'Otro'
        ];

        $servicios = Servicio::with(['ambulancia', 'cliente.User'])->paginate(15);
        return view('servicios.index', compact('servicios'));
    } 

    public function create()
    {
        $ambulancias = Ambulancia::all();
        $clientes = Cliente::with('usuario')->get();
        return view('servicios.create', compact('ambulancias', 'clientes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'costo_total' => 'required|numeric',
            'estado' => 'required|string',
            'fecha_hora' => 'required|date',
            'hora_salida' => 'nullable|date',
            'observaciones' => 'nullable|string',
            'tipo' => 'nullable|string',
            'id_ambulancia' => 'required|exists:ambulancia,id_ambulancia',
            'id_cliente' => 'required|exists:cliente,id_usuario',
        ]);
        Servicio::create($data);
        return redirect()->route('servicios.index')->with('success', 'Servicio creado.');
    }

    public function show(Servicio $servicio)
    {
        $servicio->load(['ambulancia', 'cliente.usuario', 'pacientes', 'paramedicos.usuario', 'insumos']);
        return view('servicios.show', compact('servicio'));
    }

    public function edit(Servicio $servicio)
    {
        $ambulancias = Ambulancia::all();
        $clientes = Cliente::with('usuario')->get();
        return view('servicios.edit', compact('servicio', 'ambulancias', 'clientes'));
    }

    public function update(Request $request, Servicio $servicio)
    {
        $data = $request->validate([
            'costo_total' => 'required|numeric',
            'estado' => 'required|string',
            'fecha_hora' => 'required|date',
            'hora_salida' => 'nullable|date',
            'observaciones' => 'nullable|string',
            'tipo' => 'nullable|string',
            'id_ambulancia' => 'required|exists:ambulancia,id_ambulancia',
            'id_cliente' => 'required|exists:cliente,id_usuario',
        ]);
        $servicio->update($data);
        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado.');
    }

    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return redirect()->route('servicios.index')->with('success', 'Servicio eliminado.');
    }
}
