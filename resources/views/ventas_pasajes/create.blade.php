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
                    <h4>Datos del Cliente</h4>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="numero_documento_input" class="form-label">Número de Documento:</label>
                            <div class="input-group">
                                <input type="text" id="numero_documento_input" class="form-control" placeholder="Ingresar DNI">
                                <button class="btn btn-primary" id="buscarClienteBtn">Buscar Cliente</button>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#clienteModal">
                                    Crear Cliente
                                </button>
                            </div>
                            @error('numero_documento')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>            
                        <div class="col-md-6">
                            <label for="razon_social" class="form-label">Nombres y apellidos:</label>
                            <input type="text" name="razon_social" id="razon_social" class="form-control" value="{{ old('razon_social') }}" required readonly>
                            @error('razon_social')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="documento_id" class="form-label">Tipo de documento:</label>
                            <input type="text" name="documento_id" id="documento_id" class="form-control" value="{{ old('tipo_documento') }}" required readonly>
                            @error('documento_id')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}" required readonly>
                            @error('direccion')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body text-bg-light">
                <!-- Sección: Datos del Cliente Jurídico (Empresa) -->
                <div id="cliente-juridico-section">
                    <h4>Datos de la Empresa</h4>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="numero_documento_input_empresa" class="form-label">Número de Documento:</label>
                            <div class="input-group">
                                <input type="text" id="numero_documento_input_empresa" class="form-control" placeholder="Ingresar RUC">
                                <button class="btn btn-primary" id="buscarEmpresaBtn">Buscar Empresa</button>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#empresaModal">
                                    Crear Empresa
                                </button>
                            </div>
                            @error('numero_documento')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>            
                        <div class="col-md-6">
                            <label for="razon_social" class="form-label">Razón Social:</label>
                            <input type="text" name="razon_social" id="razon_social_empresa" class="form-control" value="{{ old('razon_social') }}" required readonly>
                            @error('razon_social')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="documento_id" class="form-label">Tipo de documento:</label>
                            <input type="text" name="documento_id" id="documento_id_empresa" class="form-control" value="{{ old('tipo_documento') }}" required readonly>
                            @error('documento_id')
                                <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" name="direccion" id="direccion_empresa" class="form-control" value="{{ old('direccion') }}" required readonly>
                            @error('direccion')
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

    <!-- Modal -->
<!-- Modal para crear un cliente -->
<div class="modal fade" id="clienteModal" tabindex="-1" aria-labelledby="clienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="clienteModalLabel">Crear Cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="crearClienteForm" method="POST" action="{{ route('clientes.store1') }}">
            @csrf
            <div class="modal-body">
            <div class="card-body text-bg-light">
                <div class="row g-3">

                <!-- Tipo de persona -->
                <div class="col-md-6">
                    <label for="tipo_persona" class="form-label">Tipo de cliente:</label>
                    <select class="form-select" name="tipo_persona" id="tipo_persona">
                        <option value="" disabled>Seleccione una opción</option>
                        <option value="natural" selected>Persona natural</option>
                        <option value="juridica" {{ old('tipo_persona') == 'juridica' ? 'selected' : '' }}>Persona jurídica</option>
                    </select>
                    @error('tipo_persona')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <!-- Razón social -->
                <div class="col-12" id="box-razon-social">
                    <label id="label-natural" for="razon_social" class="form-label">Nombres y apellidos:</label>
                    <input required type="text" name="razon_social" id="razon_social" class="form-control" value="{{old('razon_social')}}">
                    @error('razon_social')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <!-- Dirección -->
                <div class="col-12">
                    <label for="direccion" class="form-label">Dirección:</label>
                    <input required type="text" name="direccion" id="direccion" class="form-control" value="{{old('direccion')}}">
                    @error('direccion')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <!-- Documento -->
                <div class="col-md-6">
                    <label for="documento_id" class="form-label">Tipo de documento:</label>
                    <select class="form-select" name="documento_id" id="documento_id">
                    <option value="" selected disabled>Seleccione una opción</option>
                    @foreach ($documentos as $item)
                        <option value="{{$item->id}}" {{ old('documento_id') == $item->id ? 'selected' : '' }}>{{$item->tipo_documento}}</option>
                    @endforeach
                    </select>
                    @error('documento_id')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="numero_documento" class="form-label">Numero de documento:</label>
                    <input required type="text" name="numero_documento" id="numero_documento" class="form-control" value="{{old('numero_documento')}}">
                    @error('numero_documento')
                    <small class="text-danger">{{'*'.$message}}</small>
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

<script>
document.getElementById("buscarClienteBtn").addEventListener("click", function(event) {
    event.preventDefault();  // Evita que el formulario se envíe y recargue la página

    const dni = document.getElementById("numero_documento_input").value.trim(); // Obtenemos el DNI ingresado

    if (dni) {
        fetch(`/buscar-cliente?dni=${dni}`)
            .then(response => response.json()) // Convertimos la respuesta a JSON
            .then(data => {
                console.log(data);  // Muestra la data de la respuesta en la consola

                if (data.success) {
                    // Si el cliente es encontrado, llenamos los campos del formulario
                    const cliente = data.data;
                    document.getElementById("razon_social").value = cliente.nombre; // Nombres y apellidos
                    document.getElementById("documento_id").value = cliente.tipo_documento; // Tipo de documento
                    document.getElementById("direccion").value = cliente.direccion; // Dirección

                    // Mostrar mensaje de éxito con SweetAlert2 (Toast)
                    Swal.fire({
                        icon: 'success',
                        title: 'Cliente encontrado',
                        text: 'Los datos del cliente se han completado exitosamente.',
                        toast: true,
                        position: 'top-right',  // Ubicación del toast
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else {
                    // Mostrar mensaje de error con SweetAlert2 (Toast)
                    Swal.fire({
                        icon: 'error',
                        title: 'Cliente no encontrado',
                        text: data.message || 'No se pudo encontrar al cliente.',
                        toast: true,
                        position: 'top-right',  // Ubicación del toast
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            })
            .catch(error => {
                console.error('Error al realizar la solicitud:', error);

                // Mostrar mensaje de error con SweetAlert2 en caso de fallo de la solicitud
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la solicitud',
                    text: 'Hubo un problema al realizar la búsqueda del cliente.',
                    toast: true,
                    position: 'top-right',  // Ubicación del toast
                    showConfirmButton: false,
                    timer: 3000
                });
            });
    } else {
        alert("Por favor ingrese un número de DNI.");
    }
});
</script>

<script>
document.getElementById("buscarEmpresaBtn").addEventListener("click", function(event) {
    event.preventDefault();  // Evita que el formulario se envíe y recargue la página

    const dni = document.getElementById("numero_documento_input_empresa").value.trim(); // Obtenemos el DNI ingresado

    if (dni) {
        fetch(`/buscar-cliente?dni=${dni}`)
            .then(response => response.json()) // Convertimos la respuesta a JSON
            .then(data => {
                console.log(data);  // Muestra la data de la respuesta en la consola

                if (data.success) {
                    // Si el cliente es encontrado, llenamos los campos del formulario
                    const cliente = data.data;
                    document.getElementById("razon_social_empresa").value = cliente.nombre; // Nombres y apellidos
                    document.getElementById("documento_id_empresa").value = cliente.tipo_documento; // Tipo de documento
                    document.getElementById("direccion_empresa").value = cliente.direccion; // Dirección

                    // Mostrar mensaje de éxito con SweetAlert2 (Toast)
                    Swal.fire({
                        icon: 'success',
                        title: 'Cliente encontrado',
                        text: 'Los datos del cliente se han completado exitosamente.',
                        toast: true,
                        position: 'top-right',  // Ubicación del toast
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else {
                    // Mostrar mensaje de error con SweetAlert2 (Toast)
                    Swal.fire({
                        icon: 'error',
                        title: 'Cliente no encontrado',
                        text: data.message || 'No se pudo encontrar al cliente.',
                        toast: true,
                        position: 'top-right',  // Ubicación del toast
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            })
            .catch(error => {
                console.error('Error al realizar la solicitud:', error);

                // Mostrar mensaje de error con SweetAlert2 en caso de fallo de la solicitud
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la solicitud',
                    text: 'Hubo un problema al realizar la búsqueda del cliente.',
                    toast: true,
                    position: 'top-right',  // Ubicación del toast
                    showConfirmButton: false,
                    timer: 3000
                });
            });
    } else {
        alert("Por favor ingrese un número de DNI.");
    }
});

</script>


@endpush

