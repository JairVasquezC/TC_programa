@extends('layouts.app')

@section('title', 'Crear Venta de Pasaje')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Venta de Pasaje</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('ventas_pasajes.index') }}">Ventas de Pasajes</a></li>
        <li class="breadcrumb-item active">Crear Venta</li>
    </ol>

    <div class="card">
        <form action="{{ route('ventas_pasajes.store') }}" method="post">
            @csrf
            <div class="card-body text-bg-light">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="viaje_id" class="form-label">Viaje:</label>
                        <select name="viaje_id" id="viaje_id" class="form-control">
                            <option value="">Seleccionar viaje</option>
                            @foreach($viajes as $viaje)
                                <option value="{{ $viaje->id }}" {{ old('viaje_id') == $viaje->id ? 'selected' : '' }}>
                                    {{ $viaje->fecha }} - {{ $viaje->hora }}
                                </option>
                            @endforeach
                        </select>
                        @error('viaje_id')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="cliente_id" class="form-label">Cliente:</label>
                        <select name="cliente_id" id="cliente_id" class="form-control">
                            <option value="">Seleccionar cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_id')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="costo" class="form-label">Costo:</label>
                        <input type="number" name="costo" id="costo" class="form-control" value="{{ old('costo') }}">
                        @error('costo')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="fecha_venta" class="form-label">Fecha de Venta:</label>
                        <input type="date" name="fecha_venta" id="fecha_venta" class="form-control" value="{{ old('fecha_venta') }}">
                        @error('fecha_venta')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="estado" class="form-label">Estado:</label>
                        <input type="text" name="estado" id="estado" class="form-control" value="{{ old('estado') }}">
                        @error('estado')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="empresa_id" class="form-label">Empresa:</label>
                        <select name="empresa_id" id="empresa_id" class="form-control">
                            <option value="">Seleccionar empresa</option>
                            @foreach($empresas as $empresa)
                                <option value="{{ $empresa->id }}" {{ old('empresa_id') == $empresa->id ? 'selected' : '' }}>
                                    {{ $empresa->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('empresa_id')
                        <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Crear Venta</button>
                <button type="reset" class="btn btn-secondary">Reiniciar</button>
            </div>
        </form>
    </div>
</div>
@endsection
