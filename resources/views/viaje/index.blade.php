@extends('layouts.app')

@section('content')
    <h1>Listado de Viajes</h1>
    <a href="{{ route('viajes.create') }}">Crear Viaje</a>
    <table>
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
            @foreach($viajes as $viaje)
                <tr>
                    <td>{{ $viaje->fecha }}</td>
                    <td>{{ $viaje->hora }}</td>
                    <td>{{ $viaje->chofer->name ?? 'Sin chofer' }}</td>
                    <td>{{ $viaje->vehiculo->placa ?? 'Sin vehículo' }}</td>
                    <td>{{ $viaje->estado ?? 'No definido' }}</td>
                    <td>
                        <a href="{{ route('viajes.edit', $viaje) }}">Editar</a>
                        <form action="{{ route('viajes.destroy', $viaje) }}" method="POST" style="display:inline;">
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
