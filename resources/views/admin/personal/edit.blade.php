@extends('layouts.admin')

@section('title', 'Editar personal')
@section('header', 'PERSONAL')

@section('content')
    <div class="max-w-3xl bg-white rounded-2xl shadow-md p-8">
        <h3 class="text-2xl font-semibold mb-6">Editar personal</h3>

        <form action="{{ route('personal.update', $user->id_usuario) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block mb-2 font-medium">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $user->nombre) }}"
                           class="w-full border rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 font-medium">Apellido paterno</label>
                    <input type="text" name="ap_paterno" value="{{ old('ap_paterno', $user->ap_paterno) }}"
                           class="w-full border rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 font-medium">Apellido materno</label>
                    <input type="text" name="ap_materno" value="{{ old('ap_materno', $user->ap_materno) }}"
                           class="w-full border rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 font-medium">Correo</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="w-full border rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 font-medium">Nueva contraseña</label>
                    <input type="password" name="password"
                           class="w-full border rounded-xl px-4 py-3"
                           placeholder="Solo si deseas cambiarla">
                </div>

                <div>
                    <label class="block mb-2 font-medium">Salario por hora</label>
                    <input type="number" step="0.01" name="salario_hora" value="{{ old('salario_hora', $salario) }}"
                           class="w-full border rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 font-medium">Tipo de personal</label>
                    <select name="tipo" class="w-full border rounded-xl px-4 py-3">
                        <option value="operador" {{ $tipo == 'operador' ? 'selected' : '' }}>Operador</option>
                        <option value="paramedico" {{ $tipo == 'paramedico' ? 'selected' : '' }}>Paramédico</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 flex gap-4">
                <button type="submit" class="bg-[#7aa6c2] text-white px-6 py-3 rounded-xl">
                    Actualizar
                </button>

                <a href="{{ route('personal.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-xl">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection