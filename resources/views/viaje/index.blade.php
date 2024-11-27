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
                        <td>{{ $viaje->estado ?? 'No definido' }}</td>
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

@endpush

