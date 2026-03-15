@extends('layouts.admin')

@section('title', 'Registrar personal')
@section('header', 'PERSONAL')

@section('content')
    <div class="max-w-3xl bg-white rounded-2xl shadow-md p-8">
        <h3 class="text-2xl font-semibold mb-6">Registrar personal</h3>

        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-red-100 border border-red-300 text-red-700 p-4">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 rounded-xl bg-red-100 border border-red-300 text-red-700 p-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('personal.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block mb-2 font-medium">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" required
                           class="w-full border rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 font-medium">Apellido paterno</label>
                    <input type="text" name="ap_paterno" value="{{ old('ap_paterno') }}" required
                           class="w-full border rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 font-medium">Apellido materno</label>
                    <input type="text" name="ap_materno" value="{{ old('ap_materno') }}"
                           class="w-full border rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full border rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 font-medium">Contraseña</label>
                    <input type="password" name="password" autocomplete="new-password" required
                           class="w-full border rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 font-medium">Salario por hora</label>
                    <input type="number" step="0.01" name="salario_hora" value="{{ old('salario_hora') }}" required
                           class="w-full border rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 font-medium">Tipo de personal</label>
                    <select name="tipo" required class="w-full border rounded-xl px-4 py-3">
                        <option value="">Seleccione</option>
                        <option value="operador" {{ old('tipo') == 'operador' ? 'selected' : '' }}>Operador</option>
                        <option value="paramedico" {{ old('tipo') == 'paramedico' ? 'selected' : '' }}>Paramédico</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 flex gap-4">
                <button type="submit" class="bg-[#7aa6c2] text-white px-6 py-3 rounded-xl hover:bg-[#6894b0]">
                    Guardar
                </button>

                <a href="{{ route('personal.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-xl">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection