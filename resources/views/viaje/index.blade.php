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
                                @can('editar-viaje')
                                <a href="{{ route('viajes.edit', $viaje) }}" class="btn btn-primary btn-sm">Editar</a>
                                @endcan

                                @can('eliminar-viaje')
                                <form action="{{ route('viajes.destroy', $viaje) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este viaje?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                                @endcan
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

