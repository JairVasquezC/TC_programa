@extends('layouts.app')

@section('title', 'Editar Viaje')

@push('css')
<style>
    #descripcion {
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Editar Viaje</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('viajes.index') }}">Viajes</a></li>
        <li class="breadcrumb-item active">Editar Viaje</li>
    </ol>

    <div class="card">
        <form action="{{ route('viajes.update', $viaje) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="card-body text-bg-light">

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="fecha" class="form-label">Fecha:</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', $viaje->fecha) }}">
                        @error('fecha')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="hora" class="form-label">Hora:</label>
                        <input type="time" name="hora" id="hora" class="form-control" value="{{ old('hora', $viaje->hora) }}">
                        @error('hora')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="id_chofer" class="form-label">Chofer:</label>
                        <select name="id_chofer" id="id_chofer" class="form-control">
                            <option value="">Seleccionar chofer</option>
                            @foreach($choferes as $chofer)
                                <option value="{{ $chofer->id }}" {{ old('id_chofer', $viaje->id_chofer) == $chofer->id ? 'selected' : '' }}>
                                    {{ $chofer->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_chofer')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="id_vehiculo" class="form-label">Vehículo:</label>
                        <select name="id_vehiculo" id="id_vehiculo" class="form-control">
                            <option value="">Seleccionar vehículo</option>
                            @foreach($vehiculos as $vehiculo)
                                <option value="{{ $vehiculo->id }}" {{ old('id_vehiculo', $viaje->id_vehiculo) == $vehiculo->id ? 'selected' : '' }}>
                                    {{ $vehiculo->placa }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_vehiculo')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="estado" class="form-label">Estado:</label>
                        <select name="estado" id="estado" class="form-control">
                            <option value="">Seleccionar estado</option>
                            <option value="Viaje Registrado" {{ old('estado', $viaje->estado) == 'Viaje Registrado' ? 'selected' : '' }}>Viaje Registrado</option>
                            <option value="Viaje en camino" {{ old('estado', $viaje->estado) == 'Viaje en camino' ? 'selected' : '' }}>Viaje en camino</option>
                            <option value="Viaje Finalizado" {{ old('estado', $viaje->estado) == 'Viaje Finalizado' ? 'selected' : '' }}>Viaje Finalizado</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="reset" class="btn btn-secondary">Reiniciar</button>
            </div>
        </form>
    </div>
</div>
@endsection
