@extends('layouts.app')

@section('title', 'Crear Viaje')

@push('css')
<style>
    #descripcion {
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Viaje</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('viajes.index') }}">Viajes</a></li>
        <li class="breadcrumb-item active">Crear Viaje</li>
    </ol>

    <div class="card">
        <form action="{{ route('viajes.store') }}" method="post">
            @csrf
            <div class="card-body text-bg-light">

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="fecha" class="form-label">Fecha:</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}">
                        @error('fecha')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="hora" class="form-label">Hora:</label>
                        <input type="time" name="hora" id="hora" class="form-control" value="{{ old('hora') }}">
                        @error('hora')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="id_chofer" class="form-label">Chofer:</label>
                        <select name="id_chofer" id="id_chofer" class="form-control">
                            <option value="">Seleccionar chofer</option>
                            @foreach($choferes as $chofer)
                                <option value="{{ $chofer->id }}" {{ old('id_chofer') == $chofer->id ? 'selected' : '' }}>
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
                                <option value="{{ $vehiculo->id }}" {{ old('id_vehiculo') == $vehiculo->id ? 'selected' : '' }}>
                                    {{ $vehiculo->placa }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_vehiculo')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    {{-- <div class="col-md-6">
                        <label for="estado" class="form-label">Estado:</label>
                        <input type="text" name="estado" id="estado" class="form-control" value="{{ old('estado') }}">
                        @error('estado')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div> --}}
                </div>

            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Crear</button>
                <button type="reset" class="btn btn-secondary">Reiniciar</button>
            </div>
        </form>
    </div>
</div>
@endsection
