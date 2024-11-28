@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Registrar Encomienda</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('encomiendas.index') }}">Encomiendas</a></li>
            <li class="breadcrumb-item active">Registrar Encomienda</li>
        </ol>
    
        <div class="card">
    <!-- Formulario -->
    <form id="encomiendaForm" method="POST" action="{{ route('encomiendas.store') }}">
        @csrf
        <!-- Sección: Datos del Cliente REMITENTE -->
        <div class="card-body text-bg-light" id="remitente-section">
            <h4>Datos del Cliente Remitente</h4>
            <div class="row g-3">
                <div class="col-md-12">
                    <label for="numero_documento_remitente" class="form-label">Número de Documento:</label>
                    <div class="input-group">
                        <input type="text" id="numero_documento_remitente" class="form-control" placeholder="Ingresar DNI">
                        <button class="btn btn-primary" id="buscarClienteRemitenteBtn">Completar</button>
                    </div>
                    @error('numero_documento')
                        <small class="text-danger">{{ '*' . $message }}</small>
                    @enderror
                </div>
                <!-- Input oculto para el ID del cliente remitente -->
                <input type="hidden" name="id_remitente" id="id_remitente" value="2">
                <div class="col-md-6">
                    <label for="razon_social_remitente" class="form-label">Nombres y apellidos:</label>
                    <input type="text" id="razon_social_remitente" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label for="documento_id_remitente" class="form-label">Tipo de documento:</label>
                    <input type="text" id="documento_id_remitente" class="form-control" readonly>
                </div>
                <div class="col-md-12">
                    <label for="direccion_remitente" class="form-label">Dirección:</label>
                    <input type="text" id="direccion_remitente" class="form-control" readonly>
                </div>
            </div>
        </div>

        <!-- Sección: Datos del Cliente Destinatario -->
        <div class="card-body text-bg-light" id="destinatario-section">
            <h4>Datos del Cliente Destinatario</h4>
            <div class="row g-3">
                <div class="col-md-12">
                    <label for="numero_documento_destinatario" class="form-label">Número de Documento:</label>
                    <div class="input-group">
                        <input type="text" id="numero_documento_destinatario" class="form-control" placeholder="Ingresar DNI">
                        <button class="btn btn-primary" id="buscarClienteDestinatarioBtn">Completar</button>
                    </div>
                    @error('numero_documento')
                        <small class="text-danger">{{ '*' . $message }}</small>
                    @enderror
                </div>
                <!-- Input oculto para el ID del cliente destintario -->
                <input type="hidden" name="id_destinatario" id="id_destinatario" value="2">
                <div class="col-md-6">
                    <label for="razon_social_destinatario" class="form-label">Nombres y apellidos:</label>
                    <input type="text" id="razon_social_destinatario" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label for="documento_id_destinatario" class="form-label">Tipo de documento:</label>
                    <input type="text" id="documento_id_destinatario" class="form-control" readonly>
                </div>
                <div class="col-md-12">
                    <label for="direccion_destinatario" class="form-label">Dirección:</label>
                    <input type="text" id="direccion_destinatario" class="form-control" readonly>
                </div>
            </div>
        </div>
        
        <!-- Sección: Datos del Cliente Empresa -->
        <div class="card-body text-bg-light" id="empresa-section">
            <h4>Datos de la Empresa</h4>
            <div class="row g-3">
                <div class="col-md-12">
                    <label for="numero_documento_empresa" class="form-label">Número de Documento:</label>
                    <div class="input-group">
                        <input type="text" id="numero_documento_empresa" class="form-control" placeholder="Ingresar RUC">
                        <button class="btn btn-primary" id="buscarClienteEmpresaBtn">Completar</button>
                    </div>
                    @error('numero_documento')
                        <small class="text-danger">{{ '*' . $message }}</small>
                    @enderror
                </div>
                <!-- Input oculto para el ID del cliente destintario -->
                <input type="hidden" name="id_empresa" id="id_empresa" value="2">
                <div class="col-md-6">
                    <label for="razon_social_empresa" class="form-label">Nombres y apellidos:</label>
                    <input type="text" id="razon_social_empresa" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label for="documento_id_empresa" class="form-label">Tipo de documento:</label>
                    <input type="text" id="documento_id_empresa" class="form-control" readonly>
                </div>
                <div class="col-md-12">
                    <label for="direccion_empresa" class="form-label">Dirección:</label>
                    <input type="text" id="direccion_empresa" class="form-control" readonly>
                </div>
            </div>
        </div>


        <div class="card-body text-bg-light">
            <!-- Fecha y Estado de Envío -->
            <div class="card-body text-bg-light">
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
            </div>

            
            <!-- Viaje -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="viaje_id" class="form-label">Viaje</label>
                    <select id="viaje_id" name="viaje_id" class="form-control" required>
                        <option value="" disabled selected>Seleccione un viaje</option>
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
            </div>

            <div id="paquetes-container">
                <h4>Agregar Paquetes:</h4>
                {{-- <label for="paquetes" class="form-label">Paquetes</label> --}}
                <button type="button" class="btn btn-sm btn-secondary mb-2 my-5" onclick="addPaquete()">Agregar Paquete</button>
            
                <!-- Contenedor de los paquetes -->
                <div class="row mb-3 paquete-entry">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="paquetes[0][descripcion]" placeholder="Descripción" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="paquetes[0][dimension_ancho]" placeholder="Ancho (cm)" min="0" step="0.01" onchange="updateTotal()" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="paquetes[0][dimension_largo]" placeholder="Largo (cm)" min="0" step="0.01" onchange="updateTotal()" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="paquetes[0][dimension_grosor]" placeholder="Grosor (cm)" min="0" step="0.01" onchange="updateTotal()" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="paquetes[0][peso]" placeholder="Peso (kg)" min="0" step="0.01" onchange="updateTotal()" required>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger" onclick="removePaquete(this)">Eliminar</button>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <strong>Total: $<span id="totalCosto">0.00</span></strong>
            </div>
            
            <!-- Campo oculto para el total que se enviará al backend -->
            <input type="hidden" name="costo_total" id="costo_total">


            <!-- Botón de Guardar -->
            <div class="row mt-4">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-success">Guardar Encomienda</button>
                </div>
            </div>

        </div>


    </form>
</div>
</div>
</div>

<!-- Modal para crear un cliente -->
<div class="modal fade" id="clienteModal" tabindex="-1" aria-labelledby="clienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clienteModalLabel">Crear Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="crearClienteForm" method="POST" action="{{ route('clientes.store2') }}">
                @csrf
                <div class="modal-body">
                    <div class="card-body text-bg-light">
                        <div class="row g-3">
                            <!-- Tipo de persona -->
                            <div class="col-md-6">
                                <label for="tipo_persona" class="form-label">Tipo de cliente:</label>
                                <select class="form-select" name="tipo_persona" id="tipo_persona" readonly>
                                    <option value="natural" selected>Persona natural</option>
                                </select>
                                @error('tipo_persona')
                                <small class="text-danger">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                            <!-- Nombres y apellidos -->
                            <div class="col-12" id="box-razon-social">
                                <label id="label-natural" for="razon_social" class="form-label">Nombres y apellidos:</label>
                                <input required type="text" name="razon_social" id="razon_social" class="form-control" value="{{ old('razon_social') }}">
                                @error('razon_social')
                                <small class="text-danger">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                            <!-- Dirección -->
                            <div class="col-12">
                                <label for="direccion" class="form-label">Dirección:</label>
                                <input required type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}">
                                @error('direccion')
                                <small class="text-danger">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                            <!-- Tipo de documento -->
                            <div class="col-md-6">
                                <label for="documento_id" class="form-label">Tipo de documento:</label>
                                <select class="form-select" name="documento_id" id="documento_id">
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    @foreach ($documentos as $item)
                                        <option value="{{ $item->id }}" {{ old('documento_id') == $item->id ? 'selected' : '' }}>{{ $item->tipo_documento }}</option>
                                    @endforeach
                                </select>
                                @error('documento_id')
                                <small class="text-danger">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                            <!-- Número de documento -->
                            <div class="col-md-6">
                                <label for="numero_documento" class="form-label">Número de documento:</label>
                                <input required type="text" name="numero_documento" id="modal_numero_documento" class="form-control" value="{{ old('numero_documento') }}">
                                @error('numero_documento')
                                <small class="text-danger">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let paqueteCount = 1; // Contador para manejar los índices de los paquetes

function addPaquete() {
    const container = document.getElementById('paquetes-container');
    const newPaquete = `
        <div class="row mb-3 paquete-entry">
            <div class="col-md-3">
                <input type="text" class="form-control" name="paquetes[${paqueteCount}][descripcion]" placeholder="Descripción" required>
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" name="paquetes[${paqueteCount}][dimension_ancho]" placeholder="Ancho (cm)" min="0" step="0.01" onchange="updateTotal()" required>
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" name="paquetes[${paqueteCount}][dimension_largo]" placeholder="Largo (cm)" min="0" step="0.01" onchange="updateTotal()" required>
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" name="paquetes[${paqueteCount}][dimension_grosor]" placeholder="Grosor (cm)" min="0" step="0.01" onchange="updateTotal()" required>
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" name="paquetes[${paqueteCount}][peso]" placeholder="Peso (kg)" min="0" step="0.01" onchange="updateTotal()" required>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger" onclick="removePaquete(this)">Eliminar</button>
            </div>
        </div>`;
    
    container.insertAdjacentHTML('beforeend', newPaquete);
    paqueteCount++; // Incrementamos el contador para el siguiente paquete
}

function removePaquete(button) {
    button.closest('.paquete-entry').remove();
    updateTotal(); // Actualizamos el total después de eliminar un paquete
}

function updateTotal() {
    let totalCosto = 0;

    // Recorremos todos los paquetes
    const paquetes = document.querySelectorAll('.paquete-entry');
    paquetes.forEach((paquete) => {
        const ancho = parseFloat(paquete.querySelector('[name$="[dimension_ancho]"]').value) || 0;
        const largo = parseFloat(paquete.querySelector('[name$="[dimension_largo]"]').value) || 0;
        const grosor = parseFloat(paquete.querySelector('[name$="[dimension_grosor]"]').value) || 0;
        const peso = parseFloat(paquete.querySelector('[name$="[peso]"]').value) || 0;
        
        // Calcular el costo del paquete basado en el peso (puedes cambiar esta fórmula)
        const costo = peso * 10; // Ejemplo: Costo = Peso * 10 (puedes ajustar según tu lógica)
        
        // Actualizar el costo total
        totalCosto += costo;
    });

    // Mostrar el costo total en la interfaz
    document.getElementById('totalCosto').textContent = totalCosto.toFixed(2);

    // Actualizar el campo oculto que se enviará al backend
    document.getElementById('costo_total').value = totalCosto.toFixed(2);
}
</script>

<script>
    document.getElementById("buscarClienteRemitenteBtn").addEventListener("click", function(event) {
        event.preventDefault(); // Evita que el formulario se envíe

        const numeroDocumento = document.getElementById("numero_documento_remitente").value.trim();

        if (numeroDocumento) {
            fetch(`/buscar-cliente?dni=${numeroDocumento}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const cliente = data.data;
                        document.getElementById("id_remitente").value = cliente.id;
                        document.getElementById("razon_social_remitente").value = cliente.nombre;
                        document.getElementById("documento_id_remitente").value = cliente.tipo_documento;
                        document.getElementById("direccion_remitente").value = cliente.direccion;

                        // Mostrar mensaje de éxito
                        Swal.fire({
                            icon: 'success',
                            title: 'Cliente encontrado',
                            text: 'Los datos del cliente se han completado.',
                            toast: true,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Cliente no encontrado',
                            text: 'No se pudo encontrar al cliente. Se abrirá el formulario de creación.',
                            toast: true,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 3000
                        });

                        // Abrir modal automáticamente
                        document.getElementById("modal_numero_documento").value = numeroDocumento;
                        document.getElementById("tipo_persona").value = "natural";
                        const clienteModal = new bootstrap.Modal(document.getElementById('clienteModal'));
                        clienteModal.show();
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al buscar el cliente.',
                        toast: true,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 3000
                    });
                });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Campo vacío',
                text: 'Por favor ingrese un número de documento.',
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000
            });
        }
    });
</script>

<script>
    document.getElementById("buscarClienteDestinatarioBtn").addEventListener("click", function(event) {
        event.preventDefault(); // Evita que el formulario se envíe

        const numeroDocumento = document.getElementById("numero_documento_destinatario").value.trim();

        if (numeroDocumento) {
            fetch(`/buscar-cliente?dni=${numeroDocumento}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const cliente = data.data;
                        document.getElementById("id_destinatario").value = cliente.id;
                        document.getElementById("razon_social_destinatario").value = cliente.nombre;
                        document.getElementById("documento_id_destinatario").value = cliente.tipo_documento;
                        document.getElementById("direccion_destinatario").value = cliente.direccion;

                        // Mostrar mensaje de éxito
                        Swal.fire({
                            icon: 'success',
                            title: 'Cliente encontrado',
                            text: 'Los datos del cliente se han completado.',
                            toast: true,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Cliente no encontrado',
                            text: 'No se pudo encontrar al cliente. Se abrirá el formulario de creación.',
                            toast: true,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 3000
                        });

                        // Abrir modal automáticamente
                        document.getElementById("modal_numero_documento").value = numeroDocumento;
                        document.getElementById("tipo_persona").value = "natural";
                        const clienteModal = new bootstrap.Modal(document.getElementById('clienteModal'));
                        clienteModal.show();
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al buscar el cliente.',
                        toast: true,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 3000
                    });
                });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Campo vacío',
                text: 'Por favor ingrese un número de documento.',
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000
            });
        }
    });
</script>
    
<script>
    document.getElementById("buscarClienteEmpresaBtn").addEventListener("click", function(event) {
        event.preventDefault(); // Evita que el formulario se envíe

        const numeroDocumento = document.getElementById("numero_documento_empresa").value.trim();

        if (numeroDocumento) {
            fetch(`/buscar-cliente?dni=${numeroDocumento}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const cliente = data.data;
                        document.getElementById("id_empresa").value = cliente.id;
                        document.getElementById("razon_social_empresa").value = cliente.nombre;
                        document.getElementById("documento_id_empresa").value = cliente.tipo_documento;
                        document.getElementById("direccion_empresa").value = cliente.direccion;

                        // Mostrar mensaje de éxito
                        Swal.fire({
                            icon: 'success',
                            title: 'Cliente encontrado',
                            text: 'Los datos del cliente se han completado.',
                            toast: true,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Cliente no encontrado',
                            text: 'No se pudo encontrar al cliente. Se abrirá el formulario de creación.',
                            toast: true,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 3000
                        });

                        // Abrir modal automáticamente
                        document.getElementById("modal_numero_documento").value = numeroDocumento;
                        document.getElementById("tipo_persona").value = "natural";
                        const clienteModal = new bootstrap.Modal(document.getElementById('clienteModal'));
                        clienteModal.show();
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al buscar el cliente.',
                        toast: true,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 3000
                    });
                });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Campo vacío',
                text: 'Por favor ingrese un número de documento.',
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000
            });
        }
    });
</script>
    
@endsection
