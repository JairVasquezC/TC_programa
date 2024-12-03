@extends('layouts.app')

@section('title', 'Viajes')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

@include('layouts.partials.alert')

<div class="container-fluid px-4">
    <h1 class="mt-4 text-black text-center">Viajes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Viajes</li>
    </ol>

    @can('crear-viaje')
    <div class="mb-4">
        <a href="{{ route('viajes.create') }}">
            <button type="button" class="btn btn-primary">Añadir nuevo viaje</button>
        </a>
    </div>
    @endcan

    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla Viajes
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped fs-6">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Chofer</th>
                        <th>Vehículo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viajes as $viaje)
                    <tr>
                        <td>{{ $viaje->fecha }}</td>
                        <td>{{ $viaje->hora }}</td>
                        <td>{{ $viaje->chofer->name ?? 'Sin chofer' }}</td>
                        <td>{{ $viaje->vehiculo->placa ?? 'Sin vehículo' }}</td>
                        <!-- <td>{{ $viaje->estado ?? 'No definido' }}</td> -->
                        <td>
                            <select class="form-select form-select-sm actualizar-estado" data-id="{{ $viaje->id }}">
                                <option value="Viaje Registrado" {{ $viaje->estado == 'Viaje Registrado' ? 'selected' : '' }}>Viaje Registrado</option>
                                <option value="Viaje en camino" {{ $viaje->estado == 'Viaje en camino' ? 'selected' : '' }}>Viaje en camino</option>
                                <option value="Viaje Finalizado" {{ $viaje->estado == 'Viaje Finalizado' ? 'selected' : '' }}>Viaje Finalizado</option>
                            </select>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around">
                                <!-- Botón de opciones (Editar) -->
                                <div>
                                    <button title="Opciones" class="btn btn-datatable btn-icon btn-transparent-dark me-2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg class="svg-inline--fa fa-ellipsis-vertical" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-vertical" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512">
                                            <path fill="currentColor" d="M56 472a56 56 0 1 1 0-112 56 56 0 1 1 0 112zm0-160a56 56 0 1 1 0-112 56 56 0 1 1 0 112zM0 96a56 56 0 1 1 112 0A56 56 0 1 1 0 96z"></path>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu text-bg-light" style="font-size: small;">
                                        @can('editar-viaje')
                                        <li><a class="dropdown-item" href="{{ route('viajes.edit', $viaje) }}">Editar</a></li>
                                        @endcan
                                    </ul>
                                </div>
                        
                                <!-- Separador visual -->
                                <div>
                                    <div class="vr"></div>
                                </div>
                        
                                <!-- Botón para eliminar viaje -->
                                <div>
                                    @can('eliminar-viaje')
                                    <button title="Eliminar" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $viaje->id }}" 
                                            class="btn btn-datatable btn-icon btn-transparent-dark">
                                        <svg class="svg-inline--fa fa-trash-can" aria-hidden="true" focusable="false" data-prefix="far" data-icon="trash-can" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path fill="currentColor" d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"></path>
                                        </svg>
                                    </button>
                                    @endcan
                                </div>
                            </div>
                        
                            <!-- Modal de confirmación -->
                            <div class="modal fade" id="confirmModal-{{ $viaje->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estás seguro de que deseas eliminar este viaje?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <form action="{{ route('viajes.destroy', $viaje) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Confirmar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal de error -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ session('error') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('error'))
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        @endif
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Detectar cambio en el select de estado
        document.querySelectorAll('.actualizar-estado').forEach(select => {
            select.addEventListener('change', function () {
                const viajeId = this.getAttribute('data-id'); // Obtener el ID del viaje
                const nuevoEstado = this.value; // Obtener el nuevo estado seleccionado

                // Enviar solicitud al servidor para actualizar el estado del viaje
                fetch(`/viajes/${viajeId}/actualizar-estado`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token CSRF para seguridad
                    },
                    body: JSON.stringify({ estado: nuevoEstado }) // Enviar el nuevo estado en el cuerpo
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Mostrar mensaje de éxito
                        Swal.fire({
                            title: 'Éxito',
                            text: 'Estado del viaje y de las encomiendas actualizado correctamente.',
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then(() => {
                            location.reload(); // Recargar la página para reflejar los cambios
                        });
                    } else {
                        // Mostrar mensaje de error si la actualización falla
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudo actualizar el estado del viaje.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                })
                .catch(error => {
                    // Manejo de errores inesperados
                    Swal.fire({
                        title: 'Error',
                        text: 'Ocurrió un error inesperado al intentar actualizar el estado.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                    console.error('Error:', error); // Mostrar error en la consola para depuración
                });
            });
        });
    });
</script>


@endpush

