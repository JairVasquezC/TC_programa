@extends('layouts.app')

@section('content')
    <h1>Listado de Vehículos</h1>
    <a href="{{ route('vehiculos.create') }}">Crear Vehículo</a>
    <table>
        <thead>
            <tr>
                <th>Placa</th>
                <th>Tipo</th>
                <th>Capacidad Peso</th>
                <th>Capacidad Personas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehiculos as $vehiculo)
                <tr>
                    <td>{{ $vehiculo->placa }}</td>
                    <td>{{ $vehiculo->tipo }}</td>
                    <td>{{ $vehiculo->capacidad_peso }}</td>
                    <td>{{ $vehiculo->capacidad_personas }}</td>
                    <td>
                        <a href="{{ route('vehiculos.edit', $vehiculo) }}">Editar</a>
                        <form action="{{ route('vehiculos.destroy', $vehiculo) }}" method="POST" style="display:inline;">
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
