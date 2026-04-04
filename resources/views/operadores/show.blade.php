<x-layouts.app :title="'Detalle Operador'">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Operador: {{ $operador->usuario->nombre ?? $operador->id_usuario }}</h5>
            <div>
                <a href="{{ route('operadores.edit', $operador) }}" class="btn btn-sm btn-warning"><i class="bx bx-edit me-1"></i>Editar</a>
                <a href="{{ route('operadores.index') }}" class="btn btn-sm btn-secondary ms-1">Volver</a>
            </div>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">ID Usuario</dt>
                <dd class="col-sm-8">{{ $operador->id_usuario }}</dd>
                <dt class="col-sm-4">Nombre</dt>
                <dd class="col-sm-8">{{ $operador->usuario->nombre ?? '—' }}</dd>
                <dt class="col-sm-4">Email</dt>
                <dd class="col-sm-8">{{ $operador->usuario->email ?? '—' }}</dd>
                <dt class="col-sm-4">Salario/Hora</dt>
                <dd class="col-sm-8">${{ number_format($operador->salario_hora, 2) }}</dd>
            </dl>
        </div>
    </div>
</x-layouts.app>
