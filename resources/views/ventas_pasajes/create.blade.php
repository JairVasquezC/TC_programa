@extends('layouts.app')

@section('title', 'Crear Venta de Pasaje')

@push('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<style>
    /* Escondemos las secciones de cliente y empresa */
    #cliente-natural-section, #cliente-juridico-section, #venta-pasaje-section {
        display: none;
    }
</style>
@endpush

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
                    <!-- Sección 1: Selección del tipo de cliente (radio buttons) -->
                    <div class="col-md-6">
                        <label class="form-label">Tipo de Cliente:</label>
                        
                        <!-- Radio buttons para seleccionar el tipo de cliente -->
                        <div class="form-check">
                            <input type="radio" name="tipo_cliente" id="tipo_cliente_natural" value="natural" class="form-check-input" 
                                {{ old('tipo_cliente') == 'natural' ? 'checked' : '' }} onchange="toggleClientSections()">
                            <label for="tipo_cliente_natural" class="form-check-label">Cliente Natural</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="tipo_cliente" id="tipo_cliente_juridica" value="juridica" class="form-check-input"
                                {{ old('tipo_cliente') == 'juridica' ? 'checked' : '' }} onchange="toggleClientSections()">
                            <label for="tipo_cliente_juridica" class="form-check-label">Cliente Jurídico</label>
                        </div>
                        
                        @error('tipo_cliente')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="card-body text-bg-light">
                <!-- Sección: Datos del Cliente Natural -->
                <div id="cliente-natural-section">
                    <h4>Datos del Cliente Natural</h4>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="cliente_id" class="form-label">Seleccionar Cliente:</label>
                            <select name="cliente_id" id="cliente_id" class="form-control"">
                                <option value="">Seleccionar cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{$cliente->persona->numero_documento}}
                                    </option>
                                @endforeach
                            </select>
                            @error('cliente_id')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>            
                        <div class="col-12">
                            <label for="razon_social" class="form-label">Nombres y apellidos:</label>
                            <input type="text" name="razon_social" id="razon_social" class="form-control" value="{{ old('razon_social') }}" required>
                            @error('razon_social')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="documento_id" class="form-label">Tipo de documento:</label>
                            <select name="documento_id" id="documento_id" class="form-control">
                                <option value="">Seleccionar tipo de documento</option>
                                @foreach ($documentos as $item)
                                    <option value="{{ $item->id }}" {{ old('documento_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->tipo_documento }}
                                    </option>
                                @endforeach
                            </select>
                            @error('documento_id')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="numero_documento" class="form-label">Número de documento:</label>
                            <input type="text" name="numero_documento" id="numero_documento" class="form-control" value="{{ old('numero_documento') }}" required>
                            @error('numero_documento')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body text-bg-light">
                <!-- Sección: Datos del Cliente Jurídico (Empresa) -->
                <div id="cliente-juridico-section">
                    <h4>Datos de la Empresa (Cliente Jurídico)</h4>
                    <div class="row g-3">
                        <!-- Datos de la empresa -->
                        <div class="col-md-6">
                            <label for="empresa_razon_social" class="form-label">Razón social de la empresa:</label>
                            <input type="text" name="empresa_razon_social" id="empresa_razon_social" class="form-control" value="{{ old('empresa_razon_social') }}" required>
                            @error('empresa_razon_social')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="ruc_empresa" class="form-label">RUC de la empresa:</label>
                            <input type="text" name="ruc_empresa" id="ruc_empresa" class="form-control" value="{{ old('ruc_empresa') }}" required>
                            @error('ruc_empresa')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Datos de la persona que hace el trámite (Cliente natural) -->
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="persona_tramite" class="form-label">Nombre de la persona que realiza el trámite:</label>
                            <input type="text" name="persona_tramite" id="persona_tramite" class="form-control" value="{{ old('persona_tramite') }}" required>
                            @error('persona_tramite')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body text-bg-light">
                <!-- Sección: Atributos de la Venta de Pasaje -->
                <div id="venta-pasaje-section">
                    <h4>Datos de la Venta del Pasaje</h4>
                    <div class="row g-3">
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
                            <label for="costo" class="form-label">Costo:</label>
                            <input type="number" name="costo" id="costo" class="form-control" value="{{ old('costo') }}" required>
                            @error('costo')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_venta" class="form-label">Fecha de Venta:</label>
                            <input type="date" name="fecha_venta" id="fecha_venta" class="form-control" value="{{ old('fecha_venta') }}" required>
                            @error('fecha_venta')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="estado" class="form-label">Estado de pago:</label>
                            <select name="estado" id="estado" class="form-control">
                                <option value="">Seleccionar estado</option>
                                <option value="credito" {{ old('estado') == 'credito' ? 'selected' : '' }}>Crédito</option>
                                <option value="efectivo" {{ old('estado') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                                <option value="transferencia" {{ old('estado') == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                                <option value="yape_plin" {{ old('estado') == 'yape_plin' ? 'selected' : '' }}>Yape/Plin</option>
                            </select>
                            @error('estado')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
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

@push('js')
<script>
    function toggleClientSections() {
        // Obtener el valor del tipo de cliente seleccionado (radio buttons)
        const tipoCliente = document.querySelector('input[name="tipo_cliente"]:checked')?.value;
        
        // Ocultar todas las secciones
        document.getElementById('cliente-natural-section').style.display = 'none';
        document.getElementById('cliente-juridico-section').style.display = 'none';
        document.getElementById('venta-pasaje-section').style.display = 'none';

        // Mostrar la sección correspondiente según el tipo de cliente
        if (tipoCliente === 'natural') {
            document.getElementById('cliente-natural-section').style.display = 'block';
        } else if (tipoCliente === 'juridica') {
            document.getElementById('cliente-juridico-section').style.display = 'block';
            document.getElementById('cliente-natural-section').style.display = 'block';
        }

        // Mostrar siempre la sección de venta de pasaje
        document.getElementById('venta-pasaje-section').style.display = 'block';
    }
</script>
<script>
    function autoFillClientData() {
        const clientId = document.getElementById('cliente_id').value;
        
        if (!clientId) return; // Si no hay cliente seleccionado, no hacer nada

        // Realizar una solicitud AJAX para obtener los datos del cliente
        fetch(`/clientes/${clientId}`)
            .then(response => response.json())
            .then(data => {
                // Llenar los campos con la información del cliente
                document.getElementById('razon_social').value = data.razon_social;
                document.getElementById('documento_id').value = data.documento_id;
                document.getElementById('numero_documento').value = data.numero_documento;
            })
            .catch(error => {
                console.error("Error al obtener los datos del cliente:", error);
            });
    }
</script>
@endpush

