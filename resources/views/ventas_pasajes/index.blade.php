@extends('layouts.app')

@section('title', 'Ventas de Pasajes')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')

@include('layouts.partials.alert')

<div class="container-fluid px-4">
    <h1 class="mt-4 text-black text-center">Ventas de Pasajes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Ventas de Pasajes</li>
    </ol>

    @can('crear-venta_pasaje')
    <div class="mb-4">
        <a href="{{ route('ventas_pasajes.create') }}">
            <button type="button" class="btn btn-primary">Añadir nueva venta</button>
        </a>
    </div>
    @endcan

    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla de Ventas
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped fs-6">
                <thead>
                    <tr>
                        <th>Viaje</th>
                        <th>Cliente</th>
                        <th>Costo</th>
                        <th>Fecha de Venta</th>
                        <th>Estado</th>
                        <th>Empresa</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Vista de ventas de pasajes -->
                    @foreach($ventasPasajes as $venta)
                    <tr>
                        <td>{{ $venta->viaje->fecha }} - {{ $venta->viaje->hora }}</td>
                        <td>{{ $venta->cliente->persona->razon_social }}</td>
                        <td>{{ $venta->costo }}</td>
                        <td>{{ $venta->fecha_venta }}</td>
                        <td>{{ $venta->estado ?? 'No definido' }}</td>
                        <td>{{ $venta->empresa->persona->razon_social ?? 'No asignada' }}</td>
                        <td>
                            <div class="d-flex justify-content-around">
                                <!-- Botón de opciones (Eliminar) -->
                                <div>
                                    <button title="Opciones" class="btn btn-datatable btn-icon btn-transparent-dark me-2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg class="svg-inline--fa fa-ellipsis-vertical" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-vertical" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512">
                                            <path fill="currentColor" d="M56 472a56 56 0 1 1 0-112 56 56 0 1 1 0 112zm0-160a56 56 0 1 1 0-112 56 56 0 1 1 0 112zM0 96a56 56 0 1 1 112 0A56 56 0 1 1 0 96z"></path>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu text-bg-light" style="font-size: small;">
                                        <!-- Opción para eliminar la venta de pasaje -->
                                        @can('eliminar-venta_pasaje')
                                        <li>
                                            <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $venta->id }}">
                                                Eliminar
                                            </button>
                                        </li>
                                        @endcan
                                    </ul>
                                </div>
                        
                                <!-- Separador visual -->
                                <div>
                                    <div class="vr"></div>
                                </div>
                        
                                <!-- Botón para generar la boleta -->
                                <div>
                                    <a href="{{ route('ventas_pasajes.boleta', $venta) }}" class="btn btn-datatable btn-icon btn-transparent-dark" title="Generar Boleta">
                                        <svg class="svg-inline--fa fa-receipt" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="receipt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                            <path fill="currentColor" d="M368 0H16C7.16 0 0 7.16 0 16v480c0 12.94 13.82 20.45 24.96 14.53L64 480l39.04 30.53C112.18 500.45 128 492.94 128 480v-16h128v16c0 12.94 13.82 20.45 24.96 14.53L320 480l39.04 30.53C370.18 500.45 384 492.94 384 480V16c0-8.84-7.16-16-16-16zM352 448l-32-24-32 24V64h64v384zM128 64v384l-32-24-32 24V64h64zm64 0v384h-64V64h64zm96 384V64h64v384h-64z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        
                            <!-- Modal de confirmación para eliminar venta -->
                            <div class="modal fade" id="confirmModal-{{ $venta->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estás seguro de que deseas eliminar esta venta?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <form action="{{ route('ventas_pasajes.destroy', $venta) }}" method="POST">
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
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush
