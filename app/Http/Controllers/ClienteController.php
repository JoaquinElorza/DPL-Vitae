<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('usuario')->paginate(15);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $usuarios = User::all();
        return view('clientes.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_usuario' => 'required|exists:users,id|unique:cliente,id_usuario',
        ]);
        Cliente::create($data);
        return redirect()->route('clientes.index')->with('success', 'Cliente creado.');
    }

    public function show(Cliente $cliente)
    {
        $cliente->load(['usuario', 'servicios']);
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        $usuarios = User::all();
        return view('clientes.edit', compact('cliente', 'usuarios'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado.');
    }
}
