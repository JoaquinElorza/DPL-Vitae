<x-layouts.app :title="'Editar Cliente'">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Editar Cliente: {{ $cliente->usuario->nombre ?? $cliente->id_usuario }}</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Usuario</label>
                    <input type="text" class="form-control" value="{{ $cliente->usuario->nombre ?? $cliente->id_usuario }} ({{ $cliente->usuario->email ?? '' }})" disabled>
                    <small class="text-muted">El usuario no puede cambiarse una vez creado el cliente.</small>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</x-layouts.app>
