<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Cliente;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $servicios = Servicio::query()
        ->when($request->tipo, function ($q, $tipo) {
            $q->where('tipo', $tipo);
        })
        ->when($request->estado, function ($q, $estado) {
            $q->where('estado', $estado);
        })
        ->get();

        $tipos = [
            'Traslado' => 'Traslados',
            'Evento' => 'Eventos',
            'Otro' => 'Otros'
        ];

        $estados = [
            'Pendiente' => 'Pendiente',
            'En curso' => 'En curso',
            'Completado' => 'Completado',
            'Cancelado' => 'Cancelado'
        ];

        return view('dashboard', compact('servicios', 'tipos', 'estados'));

  /*      $query = Servicio::query(); // o el modelo que uses
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }
        $servicios = $query->get();
        $tipos = [
            'Traslado' => 'Traslados',
            'Evento' => 'Eventos',
            'Otro' => 'Otros'
        ];
        return view('dashboard', compact('servicios', 'tipos')); /*
    }*/
}
}
