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
                                @can('editar-venta_pasaje')
                                <a href="{{ route('ventas_pasajes.edit', $venta) }}" class="btn btn-primary btn-sm">Editar</a>
                                @endcan

                                @can('eliminar-venta_pasaje')
                                <form action="{{ route('ventas_pasajes.destroy', $venta) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta venta?')">
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
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush
