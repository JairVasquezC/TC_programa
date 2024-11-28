@extends('layouts.app')

@section('title', 'Gestión de Encomiendas')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')

@include('layouts.partials.alert')

<div class="container-fluid px-4">
    <h1 class="mt-4 text-black text-center">Gestión de Encomiendas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Encomiendas</li>
    </ol>

    {{-- @can('crear-encomienda')
    <div class="mb-4">
        <a href="{{ route('encomiendas.create') }}">
            <button type="button" class="btn btn-primary">Añadir nueva encomienda</button>
        </a>
    </div>
    @endcan --}}
    <div class="mb-4">
        <a href="{{ route('encomiendas.create') }}">
            <button type="button" class="btn btn-primary">Añadir nueva encomienda</button>
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla de Encomiendas
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped fs-6">
                <thead>
                    <tr>
                        <th>Remitente</th>
                        <th>Destinatario</th>
                        <th>Costo Total</th>
                        <th>Estado</th>
                        <th>Fecha Creación</th>
                        <th>Empresa</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($encomiendas as $encomienda)
                    <tr>
                        <td>{{ $encomienda->remitente->nombre ?? 'No asignado' }}</td>
                        <td>{{ $encomienda->destinatario->nombre ?? 'No asignado' }}</td>
                        <td>{{ $encomienda->costo_total }}</td>
                        <td>{{ $encomienda->estado_envio ?? 'No definido' }}</td>
                        <td>{{ $encomienda->created_at->format('d/m/Y') }}</td>
                        <td>{{ $encomienda->empresa->nombre ?? 'No asignada' }}</td>
                        <td>
                            <div class="d-flex justify-content-around">
                                @can('editar-encomienda')
                                <a href="{{ route('encomiendas.edit', $encomienda) }}" class="btn btn-primary btn-sm">Editar</a>
                                @endcan

                                @can('eliminar-encomienda')
                                <form action="{{ route('encomiendas.destroy', $encomienda) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta encomienda?')">
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
