@section('title', 'Editar Empresa')
<x-layouts.app :title="'Editar Empresa'">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Editar Empresa</h5>
            <a href="{{ route('empresas.index') }}" class="btn btn-secondary btn-sm">
                <i class="bx bx-arrow-back me-1"></i> Volver
            </a>
        </div>
        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible mb-4" role="alert">
                    <strong>Corrige los siguientes errores:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('empresas.update', $empresa) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ── Información General ── --}}
                <h6 class="text-muted text-uppercase small fw-semibold mb-3 mt-2">
                    <i class="bx bx-building me-1"></i> Información General
                </h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Nombre <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            name="nombre"
                            class="form-control @error('nombre') is-invalid @enderror"
                            value="{{ old('nombre', $empresa->nombre) }}"
                            required
                            placeholder="Nombre de la empresa"
                        >
                        @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Slogan</label>
                        <input
                            type="text"
                            name="slogan"
                            class="form-control @error('slogan') is-invalid @enderror"
                            value="{{ old('slogan', $empresa->slogan) }}"
                            placeholder="Frase que identifica a la empresa"
                        >
                        @error('slogan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Descripción</label>
                        <textarea
                            name="descripcion"
                            rows="3"
                            class="form-control @error('descripcion') is-invalid @enderror"
                            placeholder="Breve descripción de la empresa..."
                        >{{ old('descripcion', $empresa->descripcion) }}</textarea>
                        @error('descripcion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- ── Misión, Visión y Valores ── --}}
                <h6 class="text-muted text-uppercase small fw-semibold mb-3">
                    <i class="bx bx-target-lock me-1"></i> Misión, Visión y Valores
                </h6>
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <label class="form-label">Misión</label>
                        <textarea
                            name="mision"
                            rows="3"
                            class="form-control @error('mision') is-invalid @enderror"
                            placeholder="¿Cuál es el propósito de la empresa?"
                        >{{ old('mision', $empresa->mision) }}</textarea>
                        @error('mision')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Visión</label>
                        <textarea
                            name="vision"
                            rows="3"
                            class="form-control @error('vision') is-invalid @enderror"
                            placeholder="¿Hacia dónde se dirige la empresa a futuro?"
                        >{{ old('vision', $empresa->vision) }}</textarea>
                        @error('vision')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Valores</label>
                        <textarea
                            name="valores"
                            rows="3"
                            class="form-control @error('valores') is-invalid @enderror"
                            placeholder="Escribe los valores separados por coma o en líneas separadas. Ej: Honestidad, Compromiso, Respeto"
                        >{{ old('valores', $empresa->valores) }}</textarea>
                        <small class="text-muted">Separa cada valor con una coma o salto de línea.</small>
                        @error('valores')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- ── Contacto ── --}}
                <h6 class="text-muted text-uppercase small fw-semibold mb-3">
                    <i class="bx bx-phone me-1"></i> Información de Contacto
                </h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input
                            type="text"
                            name="telefono"
                            class="form-control @error('telefono') is-invalid @enderror"
                            value="{{ old('telefono', $empresa->telefono) }}"
                            placeholder="Ej: 951 123 4567"
                        >
                        @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Correo electrónico</label>
                        <input
                            type="email"
                            name="correo"
                            class="form-control @error('correo') is-invalid @enderror"
                            value="{{ old('correo', $empresa->correo) }}"
                            placeholder="contacto@empresa.com"
                        >
                        @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Sitio Web</label>
                        <input
                            type="text"
                            name="sitio_web"
                            class="form-control @error('sitio_web') is-invalid @enderror"
                            value="{{ old('sitio_web', $empresa->sitio_web) }}"
                            placeholder="https://www.empresa.com"
                        >
                        @error('sitio_web')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Dirección</label>
                        <input
                            type="text"
                            name="direccion"
                            class="form-control @error('direccion') is-invalid @enderror"
                            value="{{ old('direccion', $empresa->direccion) }}"
                            placeholder="Calle, número, colonia, ciudad"
                        >
                        @error('direccion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- ── Cotizaciones ── --}}
                <h6 class="text-muted text-uppercase small fw-semibold mb-3">
                    <i class="bx bx-calculator me-1"></i> Configuración de Cotizaciones
                </h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label">Costo por kilómetro <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input
                                type="number"
                                name="costo_km"
                                step="0.01"
                                min="0"
                                class="form-control @error('costo_km') is-invalid @enderror"
                                value="{{ old('costo_km', $empresa->costo_km ?? 25.00) }}"
                                required
                            >
                            <span class="input-group-text">MXN/km</span>
                        </div>
                        <small class="text-muted">Tarifa base para calcular cotizaciones por distancia.</small>
                        @error('costo_km')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- ── Imágenes ── --}}
                <h6 class="text-muted text-uppercase small fw-semibold mb-3">
                    <i class="bx bx-image me-1"></i> Imágenes
                </h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Logo <small class="text-muted">(máx 2MB)</small></label>
                        @if($empresa->logo_nombre)
                            <div class="mb-2 p-2 border rounded d-inline-flex align-items-center gap-2">
                                <img src="{{ asset('storage/' . $empresa->logo_nombre) }}"
                                     alt="Logo actual" style="height:50px; object-fit:contain;">
                                <small class="text-muted">Logo actual</small>
                            </div>
                        @endif
                        <input
                            type="file"
                            name="logo"
                            class="form-control @error('logo') is-invalid @enderror"
                            accept="image/*"
                        >
                        <small class="text-muted">Dejar vacío para conservar el actual. Se mostrará en la barra de navegación.</small>
                        @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Imagen Principal <small class="text-muted">(máx 4MB)</small></label>
                        @if($empresa->imagen_nombre)
                            <div class="mb-2 p-2 border rounded d-inline-flex align-items-center gap-2">
                                <img src="{{ asset('storage/' . $empresa->imagen_nombre) }}"
                                     alt="Imagen actual" style="height:50px; object-fit:contain;">
                                <small class="text-muted">Imagen actual</small>
                            </div>
                        @endif
                        <input
                            type="file"
                            name="imagen"
                            class="form-control @error('imagen') is-invalid @enderror"
                            accept="image/*"
                        >
                        <small class="text-muted">Dejar vacío para conservar la actual. Se mostrará en el hero y la sección "Nosotros".</small>
                        @error('imagen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- ── Acciones ── --}}
                <div class="d-flex gap-2 pt-2 border-top">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save me-1"></i> Actualizar Empresa
                    </button>
                    <a href="{{ route('empresas.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>

            </form>
        </div>
    </div>
</x-layouts.app>