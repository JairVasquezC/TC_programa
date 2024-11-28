@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Registrar Encomienda</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ventas_pasajes.index') }}">Encomiendas</a></li>
            <li class="breadcrumb-item active">Registrar Encomienda</li>
        </ol>
    
        <div class="card">
    <!-- Formulario -->
    <form id="encomiendaForm" method="POST" action="{{ route('encomiendas.store') }}">
        @csrf
        
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

        <!-- Sección: Datos del Cliente REMITENTE -->
        <div class="card-body text-bg-light" id="remitente-section">
            <h4>Datos del Cliente Remitente</h4>
            <div class="row g-3">
                <div class="col-md-12">
                    <label for="numero_documento_remitente" class="form-label">Número de Documento:</label>
                    <div class="input-group">
                        <input type="text" id="numero_documento_remitente" class="form-control" placeholder="Ingresar DNI">
                        <button class="btn btn-primary buscar-cliente-btn">Buscar Cliente</button>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#clienteModal">
                            Crear Cliente
                        </button>
                    </div>
                </div>
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
                <!-- Input oculto para el ID del cliente remitente -->
                <input name="id_remitente" id="id_remitente" value="2">
            </div>
        </div>

        <div class="card-body text-bg-light" id="destinatario-section">
            <h4>Datos del Cliente Destinatario</h4>
            <div class="row g-3">
                <div class="col-md-12">
                    <label for="numero_documento_destinatario" class="form-label">Número de Documento:</label>
                    <div class="input-group">
                        <input type="text" id="numero_documento_destinatario" class="form-control" placeholder="Ingresar DNI">
                        <button class="btn btn-primary buscar-cliente-btn">Buscar Cliente</button>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#clienteModal">
                            Crear Cliente
                        </button>
                    </div>
                </div>
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
                <!-- Input oculto para el ID del cliente destinatario -->
                <input  name="id_destinatario" id="id_destinatario" value="1">
            </div>
        </div>
        
        <div class="card-body text-bg-light">
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
{{-- 
<script>
    document.getElementById("buscarClienteBtn").addEventListener("click", function(event) {
    event.preventDefault(); // Evita recargar la página

    const dni = document.getElementById("numero_documento_input").value.trim();

    if (dni === "") {
        Swal.fire({
            icon: 'warning',
            title: 'Atención',
            text: 'Por favor, ingresa un número de documento.',
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000
        });
        return;
    }

    fetch(`/buscar-cliente?dni=${dni}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const cliente = data.data;

                // Llenar los campos
                document.getElementById("razon_social").value = cliente.nombre;
                document.getElementById("documento_id").value = cliente.tipo_documento;
                document.getElementById("direccion").value = cliente.direccion;

                // Notificar éxito
                Swal.fire({
                    icon: 'success',
                    title: 'Cliente encontrado',
                    text: 'Los datos del cliente se han completado exitosamente.',
                    toast: true,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000
                });
            } else {
                throw new Error(data.message || 'No se pudo encontrar al cliente.');
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Hubo un problema al realizar la búsqueda.',
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000
            });
        });
});

    </script> --}}
    
    <script>
  document.addEventListener("click", function (event) {
    if (event.target.classList.contains("buscar-cliente-btn")) {
        const section = event.target.closest(".card-body"); // Encuentra la sección contenedora
        const dniInput = section.querySelector("input[id='numero_documento_remitente']"); // Input del DNI
        const razonSocialInput = section.querySelector("input[id='razon_social_remitente']");
        const documentoIdInput = section.querySelector("input[id='documento_id_remitente']");
        const direccionInput = section.querySelector("input[id='direccion_remitente']");
        const idRemitenteInput = section.querySelector("input[id='id_remitente']"); // Input oculto para el ID del cliente

        const dni = dniInput.value.trim();

        if (dni) {
            fetch(`/buscar-cliente?dni=${dni}`)
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        // Si el cliente es encontrado, llenamos los campos del formulario
                        const cliente = data.data;
                        razonSocialInput.value = cliente.nombre;
                        documentoIdInput.value = cliente.tipo_documento;
                        direccionInput.value = cliente.direccion;
                        idRemitenteInput.value = cliente.id; // Asignar el ID del cliente al input oculto

                        // Mostrar mensaje de éxito
                        Swal.fire({
                            icon: "success",
                            title: "Cliente encontrado",
                            text: "Los datos del cliente se han completado exitosamente.",
                            toast: true,
                            position: "top-right",
                            showConfirmButton: false,
                            timer: 3000,
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Cliente no encontrado",
                            text: data.message || "No se pudo encontrar al cliente.",
                            toast: true,
                            position: "top-right",
                            showConfirmButton: false,
                            timer: 3000,
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error al realizar la solicitud:", error);

                    Swal.fire({
                        icon: "error",
                        title: "Error en la solicitud",
                        text: "Hubo un problema al realizar la búsqueda del cliente.",
                        toast: true,
                        position: "top-right",
                        showConfirmButton: false,
                        timer: 3000,
                    });
                });
        } else {
            Swal.fire({
                icon: "warning",
                title: "Campo vacío",
                text: "Por favor, ingresa un número de DNI.",
                toast: true,
                position: "top-right",
                showConfirmButton: false,
                timer: 3000,
            });
        }
    }
});

    
    </script>
<script>
document.addEventListener("click", function (event) {
    if (event.target.classList.contains("buscar-cliente-btn")) {
        const section = event.target.closest(".card-body"); // Encuentra la sección contenedora
        const dniInput = section.querySelector("input[id='numero_documento_destinatario']"); // Input del DNI
        const razonSocialInput = section.querySelector("input[id='razon_social_destinatario']");
        const documentoIdInput = section.querySelector("input[id='documento_id_destinatario']");
        const direccionInput = section.querySelector("input[id='direccion_destinatario']");
        const idDestinatarioInput = section.querySelector("input[id='id_destinatario']"); // Input oculto para el ID del cliente

        const dni = dniInput.value.trim();

        if (dni) {
            fetch(`/buscar-cliente?dni=${dni}`)
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        // Si el cliente es encontrado, llenamos los campos del formulario
                        const cliente = data.data;
                        razonSocialInput.value = cliente.nombre;
                        documentoIdInput.value = cliente.tipo_documento;
                        direccionInput.value = cliente.direccion;
                        idDestinatarioInput.value = cliente.id; // Asignar el ID del cliente al input oculto

                        // Mostrar mensaje de éxito
                        Swal.fire({
                            icon: "success",
                            title: "Cliente encontrado",
                            text: "Los datos del cliente se han completado exitosamente.",
                            toast: true,
                            position: "top-right",
                            showConfirmButton: false,
                            timer: 3000,
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Cliente no encontrado",
                            text: data.message || "No se pudo encontrar al cliente.",
                            toast: true,
                            position: "top-right",
                            showConfirmButton: false,
                            timer: 3000,
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error al realizar la solicitud:", error);

                    Swal.fire({
                        icon: "error",
                        title: "Error en la solicitud",
                        text: "Hubo un problema al realizar la búsqueda del cliente.",
                        toast: true,
                        position: "top-right",
                        showConfirmButton: false,
                        timer: 3000,
                    });
                });
        } else {
            Swal.fire({
                icon: "warning",
                title: "Campo vacío",
                text: "Por favor, ingresa un número de DNI.",
                toast: true,
                position: "top-right",
                showConfirmButton: false,
                timer: 3000,
            });
        }
    }
});
</script>
    
@endsection
