<x-layouts.app :title="'Servicios'">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Servicios</h5>
            <a href="{{ route('servicios.create') }}" class="btn btn-primary btn-sm">
                <i class="bx bx-plus me-1"></i> Nuevo
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Fecha/Hora</th>
                        <th>Costo Total</th>
                        <th>Ambulancia</th>
                        <th>Cliente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($servicios as $servicio)
                    <tr>
                        <td>{{ $servicio->id_servicio }}</td>
                        <td>{{ $servicio->tipo ?? '—' }}</td>
                        <td>{{ $servicio->estado }}</td>
                        <td>{{ $servicio->fecha_hora }}</td>
                        <td>${{ number_format($servicio->costo_total, 2) }}</td>
                        <td>{{ $servicio->ambulancia->placa ?? '—' }}</td>
                        <td>{{ $servicio->cliente->usuario->nombre ?? '—' }}</td>
                        <td>
                            <a href="{{ route('servicios.show', $servicio) }}" class="btn btn-sm btn-info"><i class="bx bx-show"></i></a>
                            <a href="{{ route('servicios.edit', $servicio) }}" class="btn btn-sm btn-warning"><i class="bx bx-edit"></i></a>
                            <form action="{{ route('servicios.destroy', $servicio) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">Sin registros</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $servicios->links() }}</div>
    </div>
</x-layouts.app>
