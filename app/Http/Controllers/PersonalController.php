<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Operador;
use App\Models\Paramedico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PersonalController extends Controller
{
public function index()
    {
        $operadores = User::join('operador', 'users.id_usuario', '=', 'operador.id_usuario')
            ->select(
                'users.id_usuario',
                'users.nombre',
                'users.ap_paterno',
                'users.ap_materno',
                'users.email',
                'operador.salario_hora',
                DB::raw("'Operador' as tipo")
            );

        $paramedicos = User::join('paramedico', 'users.id_usuario', '=', 'paramedico.id_usuario')
            ->select(
                'users.id_usuario',
                'users.nombre',
                'users.ap_paterno',
                'users.ap_materno',
                'users.email',
                'paramedico.salario_hora',
                DB::raw("'Paramédico' as tipo")
            );

        $personal = $operadores->union($paramedicos)->get();

        return view('admin.personal.index', compact('personal'));
    }

    public function create()
    {
        return view('admin.personal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'ap_paterno' => 'required|string|max:100',
            'ap_materno' => 'nullable|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'salario_hora' => 'required|numeric|min:0',
            'tipo' => 'required|in:operador,paramedico',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'nombre' => $request->nombre,
                'ap_paterno' => $request->ap_paterno,
                'ap_materno' => $request->ap_materno,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($request->tipo === 'operador') {
                Operador::create([
                    'id_usuario' => $user->id_usuario,
                    'salario_hora' => $request->salario_hora,
                ]);
            } else {
                Paramedico::create([
                    'id_usuario' => $user->id_usuario,
                    'salario_hora' => $request->salario_hora,
                ]);
            }

            DB::commit();

            return redirect()->route('personal.index')->with('success', 'Personal registrado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error al registrar: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $tipo = null;
        $salario = null;

        if ($user->operador) {
            $tipo = 'operador';
            $salario = $user->operador->salario_hora;
        } elseif ($user->paramedico) {
            $tipo = 'paramedico';
            $salario = $user->paramedico->salario_hora;
        }

        return view('admin.personal.edit', compact('user', 'tipo', 'salario'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'ap_paterno' => 'required|string|max:100',
            'ap_materno' => 'nullable|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id . ',id_usuario',
            'salario_hora' => 'required|numeric|min:0',
            'tipo' => 'required|in:operador,paramedico',
        ]);

        DB::beginTransaction();

        try {
            $user->update([
                'nombre' => $request->nombre,
                'ap_paterno' => $request->ap_paterno,
                'ap_materno' => $request->ap_materno,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            Operador::where('id_usuario', $id)->delete();
            Paramedico::where('id_usuario', $id)->delete();

            if ($request->tipo === 'operador') {
                Operador::create([
                    'id_usuario' => $user->id_usuario,
                    'salario_hora' => $request->salario_hora,
                ]);
            } else {
                Paramedico::create([
                    'id_usuario' => $user->id_usuario,
                    'salario_hora' => $request->salario_hora,
                ]);
            }

            DB::commit();

            return redirect()->route('personal.index')->with('success', 'Personal actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error al actualizar: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        DB::beginTransaction();

        try {
            Operador::where('id_usuario', $id)->delete();
            Paramedico::where('id_usuario', $id)->delete();
            $user->delete();

            DB::commit();

            return redirect()->route('personal.index')->with('success', 'Personal eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
}
