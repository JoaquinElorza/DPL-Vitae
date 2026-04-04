<x-layouts.app :title="'Nuevo Cliente'">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Nuevo Cliente</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Usuario <span class="text-danger">*</span></label>
                        <select name="id_usuario" class="form-select @error('id_usuario') is-invalid @enderror" required>
                            <option value="">-- Seleccionar usuario --</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ old('id_usuario') == $usuario->id ? 'selected' : '' }}>
                                    {{ $usuario->nombre }} ({{ $usuario->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_usuario')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
