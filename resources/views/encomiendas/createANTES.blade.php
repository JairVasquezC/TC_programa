@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Registrar Encomienda</h1>

    <!-- Formulario -->
    <form id="encomiendaForm" method="POST" action="{{ route('encomiendas.store') }}">
        @csrf
        
        <!-- Fecha y Estado de Envío -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="fecha_registro" class="form-label">Fecha de Registro</label>
                <input type="date" id="fecha_registro" name="fecha_registro" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="estado_envio" class="form-label">Estado de Envío</label>
                <select id="estado_envio" name="estado_envio" class="form-control" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Enviado">Enviado</option>
                    <option value="Entregado">Entregado</option>
                </select>
            </div>
        </div>

        <!-- Cliente -->
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="cliente_id" class="form-label">Cliente</label>
                <select id="cliente_id" name="cliente_id" class="form-control" required>
                    <option value="" disabled selected>Seleccione un cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->persona->razon_social }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Viaje -->
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="viaje_id" class="form-label">Viaje</label>
                <select id="viaje_id" name="viaje_id" class="form-control" required>
                    <option value="" disabled selected>Seleccione un viaje</option>
                    @foreach($viajes as $viaje)
                        <option value="{{ $viaje->id }}">{{ $viaje->fecha }} - {{ $viaje->hora }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Paquetes -->
        <div class="row mb-3">
            <div class="col-md-6">
                <h4>Paquete</h4>
            </div>
            <div class="col-md-6 text-end">
                <button type="button" id="btnAgregarPaquete" class="btn btn-primary">Agregar Paquete</button>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <label for="dimension_ancho" class="form-label">Ancho</label>
                <input type="number" id="dimension_ancho" name="dimension_ancho" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="dimension_largo" class="form-label">Largo</label>
                <input type="number" id="dimension_largo" name="dimension_largo" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="dimension_grosor" class="form-label">Grosor</label>
                <input type="number" id="dimension_grosor" name="dimension_grosor" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="dimension_peso" class="form-label">Peso</label>
                <input type="number" id="dimension_peso" name="dimension_peso" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="form-control"></textarea>
            </div>
        </div>

        <!-- Tabla de Paquetes -->
        <div class="row">
            <div class="col-md-12">
                <h5>Lista de Paquetes</h5>
                <table class="table table-striped" id="tablaPaquetes">
                    <thead>
                        <tr>
                            <th>Ancho</th>
                            <th>Largo</th>
                            <th>Grosor</th>
                            <th>Peso</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Paquetes dinámicos -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Botón de Guardar -->
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-success">Guardar Encomienda</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('btnAgregarPaquete').addEventListener('click', function() {
        const ancho = document.getElementById('dimension_ancho').value;
        const largo = document.getElementById('dimension_largo').value;
        const grosor = document.getElementById('dimension_grosor').value;
        const peso = document.getElementById('dimension_peso').value;
        const descripcion = document.getElementById('descripcion').value;

        if (ancho && largo && grosor && peso && descripcion) {
            const tabla = document.getElementById('tablaPaquetes').querySelector('tbody');
            const fila = `
                <tr>
                    <td>${ancho}</td>
                    <td>${largo}</td>
                    <td>${grosor}</td>
                    <td>${peso}</td>
                    <td>${descripcion}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm btnEliminar">Eliminar</button>
                    </td>
                </tr>`;
            tabla.insertAdjacentHTML('beforeend', fila);

            document.getElementById('dimension_ancho').value = '';
            document.getElementById('dimension_largo').value = '';
            document.getElementById('dimension_grosor').value = '';
            document.getElementById('dimension_peso').value = '';
            document.getElementById('descripcion').value = '';
        }
    });

    document.getElementById('tablaPaquetes').addEventListener('click', function(e) {
        if (e.target.classList.contains('btnEliminar')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@endsection
