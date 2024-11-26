@extends('layouts.app')

@section('content')
    <h1>Ventas de Pasajes</h1>
    <a href="{{ route('ventas_pasajes.create') }}">Crear Venta de Pasaje</a>
    <table>
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
                    <td>{{ $venta->cliente->nombre }}</td>
                    <td>{{ $venta->costo }}</td>
                    <td>{{ $venta->fecha_venta }}</td>
                    <td>{{ $venta->estado ?? 'No definido' }}</td>
                    <td>{{ $venta->empresa->nombre ?? 'No asignada' }}</td>
                    <td>
                        <a href="{{ route('ventas_pasajes.edit', $venta) }}">Editar</a>
                        <form action="{{ route('ventas_pasajes.destroy', $venta) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
