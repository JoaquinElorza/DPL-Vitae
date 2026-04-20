<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Cliente;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Servicio::query(); // o el modelo que uses

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        $servicios = $query->get();

        $tipos = [
            'Traslado' => 'Traslados',
            'Evento' => 'Eventos',
            'Otro' => 'Otros'
        ];

        return view('dashboard', compact('servicios', 'tipos'));
    }


  /*  public function index(Request $request)
    {
        $tipos = [
            'Traslado' => 'Traslados programados',
            'Evento' => 'Eventos',
            'Otro' => 'Otros',
        ];

        return view('dashboard', compact('tipos'));
    }*/
}
