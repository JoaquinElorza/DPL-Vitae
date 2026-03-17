@extends('layouts.admin')

@section('title', 'Registrar Padecimiento')
@section('header', 'PADECIMIENTOS')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h3 class="text-2xl font-semibold">Registrar nuevo padecimiento</h3>
        <a href="{{ route('padecimientos.index') }}"
           class="bg-gray-200 text-gray-700 px-5 py-3 rounded-xl hover:bg-gray-300 transition">
            ← Volver al listado
        </a>
    </div>

    @if($errors->any())
        <div class="mb-4 p-4 rounded-xl bg-red-100 text-red-700">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-md p-8 max-w-2xl">
        <form action="{{ route('padecimientos.store') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label for="nombre_padecimiento" class="block text-sm font-medium text-gray-700 mb-1">
                    Nombre del padecimiento <span class="text-red-600">*</span>
                </label>
                <input
                    type="text"
                    id="nombre_padecimiento"
                    name="nombre_padecimiento"
                    value="{{ old('nombre_padecimiento') }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#d90000] focus:border-transparent"
                    placeholder="Ej. Diabetes, Hipertensión..."
                    required
                >
            </div>

            <div class="mb-5">
                <label for="nivel_riesgo" class="block text-sm font-medium text-gray-700 mb-1">
                    Nivel de riesgo
                </label>
                <select
                    id="nivel_riesgo"
                    name="nivel_riesgo"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#d90000] focus:border-transparent"
                >
                    <option value="">Sin especificar</option>
                    <option value="Bajo" {{ old('nivel_riesgo') == 'Bajo' ? 'selected' : '' }}>Bajo</option>
                    <option value="Medio" {{ old('nivel_riesgo') == 'Medio' ? 'selected' : '' }}>Medio</option>
                    <option value="Alto" {{ old('nivel_riesgo') == 'Alto' ? 'selected' : '' }}>Alto</option>
                    <option value="Crítico" {{ old('nivel_riesgo') == 'Crítico' ? 'selected' : '' }}>Crítico</option>
                </select>
            </div>

            <div class="mb-8">
                <label for="costo_extra" class="block text-sm font-medium text-gray-700 mb-1">
                    Costo extra ($)
                </label>
                <input
                    type="number"
                    id="costo_extra"
                    name="costo_extra"
                    value="{{ old('costo_extra') }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#d90000] focus:border-transparent"
                    placeholder="0.00"
                    step="0.01"
                    min="0"
                >
                <p class="text-xs text-gray-400 mt-1">Dejar vacío si no aplica costo extra.</p>
            </div>

            <div class="flex gap-3">
                <button
                    type="submit"
                    class="bg-[#d90000] text-white px-6 py-3 rounded-xl hover:bg-red-800 transition font-medium">
                    Guardar padecimiento
                </button>
                <a href="{{ route('padecimientos.index') }}"
                   class="bg-gray-100 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-200 transition font-medium">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection