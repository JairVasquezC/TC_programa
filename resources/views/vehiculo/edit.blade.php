@extends('layouts.app')

@section('title', 'Editar Vehículo')

@push('css')
<style>
    #descripcion {
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Editar Vehículo</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('vehiculos.index') }}">Vehículos</a></li>
        <li class="breadcrumb-item active">Editar Vehículo</li>
    </ol>

    <div class="card">
        <form action="{{ route('vehiculos.update', $vehiculo) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="card-body text-bg-light">

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="placa" class="form-label">Placa:</label>
                        <input type="text" name="placa" id="placa" class="form-control" value="{{ old('placa', $vehiculo->placa) }}">
                        @error('placa')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="tipo" class="form-label">Tipo:</label>
                        <input type="text" name="tipo" id="tipo" class="form-control" value="{{ old('tipo', $vehiculo->tipo) }}">
                        @error('tipo')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="capacidad_peso" class="form-label">Capacidad Peso:</label>
                        <input type="number" name="capacidad_peso" id="capacidad_peso" class="form-control" value="{{ old('capacidad_peso', $vehiculo->capacidad_peso) }}">
                        @error('capacidad_peso')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="capacidad_personas" class="form-label">Capacidad Personas:</label>
                        <input type="number" name="capacidad_personas" id="capacidad_personas" class="form-control" value="{{ old('capacidad_personas', $vehiculo->capacidad_personas) }}">
                        @error('capacidad_personas')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
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
