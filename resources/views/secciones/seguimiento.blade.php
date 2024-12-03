@extends('landing.plantilla')

@section('title', 'Transporte Cerna')
<link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
<link rel="manifest" href="assets/img/favicons/manifest.json">
<meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
<meta name="theme-color" content="#ffffff">
@section('contenido')

    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="assets/img/img02.jpg" alt="Transportes Cerna 2" class="d-block w-100" style="height: 580px; object-fit: cover;">
            </div>
            <div class="carousel-item">
            <img src="assets/img/img03.jpg" alt="Transportes Cerna 3" class="d-block w-100" style="height: 580px; object-fit: cover;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

<div class="container py-5">
    <!-- Título -->
    <h2 class="text-center mb-4">Rastreo de Carga</h2>
    <p class="text-center mb-5">
        Ingresa tu número de rastreo y DNI para conocer el estado de tu envío.
    </p>
    <!-- Formulario -->
    <form id="rastreoForm" class="rounded p-4 mb-5">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="codigo" class="form-label">Número de Rastreo</label>
                <input type="text" id="codigo" class="form-control" placeholder="Número de Rastreo">
            </div>
            <div class="col-md-6">
                <label for="dni" class="form-label">DNI del Remitente</label>
                <input type="text" id="dni" class="form-control" placeholder="DNI">
            </div>
        </div>
        <div class="mt-4 text-center">
            <button type="button" id="buscarPedido" class="btn btn-danger" style="background: #E01A1A">Buscar</button>
        </div>
    </form>

    <!-- Mensaje de Error -->
    <p id="errorMensaje" class="text-danger text-center d-none">No se encontró el pedido con los datos ingresados.</p>

    <!-- Resultado -->
    <div id="resultadoPedido" class="d-none bg-white shadow rounded p-4">
        <h4 class="text-danger fw-bold">Estado del Envío</h4>
        <p id="descripcionPedido" class="text-muted"></p>
        <p id="fechaRegistro" class="text-muted"></p> <!-- Fecha de registro -->
    
        <div class="position-relative d-flex justify-content-between align-items-center mt-4">
            <!-- Línea de progreso -->
            <div class="position-absolute top-50 start-0 w-100 bg-danger" style="height: 4px; z-index: -1;"></div>
    
            <!-- Estados -->
            @foreach ($estadosEnvio as $estado)
            <div class="text-center flex-grow-1">
                <div class="rounded-circle border border-4 mb-2 mx-auto" 
                    id="estado-{{ $estado['id'] }}" 
                    style="width: 80px; height: 80px; background-color: #ddd;">
                    <img src="{{ asset($estado['imagen']) }}" alt="{{ $estado['nombre'] }}" 
                        class="w-50 h-50">
                </div>
                <p class="text-muted">{{ $estado['nombre'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Derechos Reservados -->
<div class="text-center py-3" style="background-color: #E01A1A;">
    <p class="mb-0 text-white">© 2024 Cerna - Todos los derechos reservados.</p>
  </div>
  
<script>
document.addEventListener('DOMContentLoaded', () => {
    const codigoInput = document.getElementById('codigo');
    const dniInput = document.getElementById('dni');
    const buscarBtn = document.getElementById('buscarPedido');
    const errorMensaje = document.getElementById('errorMensaje');
    const resultadoPedido = document.getElementById('resultadoPedido');
    const descripcionPedido = document.getElementById('descripcionPedido');
    const fechaRegistro = document.getElementById('fechaRegistro'); // Para mostrar la fecha de registro

    buscarBtn.addEventListener('click', async () => {
        const codigo = codigoInput.value.trim();
        const dni = dniInput.value.trim();

        // Realiza la solicitud AJAX
        const response = await fetch(`/buscar-pedido?codigo=${codigo}&dni=${dni}`);
        const data = await response.json();

        if (data.success) {
            // Mostrar detalles del pedido
            errorMensaje.classList.add('d-none');
            resultadoPedido.classList.remove('d-none');
            descripcionPedido.textContent = `Estado actual: ${data.estadoEnvio}`;
            fechaRegistro.textContent = `Fecha de Registro: ${data.fecha_registro}`;

            // Actualizar el estado visual
            const estadosEnvio = @json($estadosEnvio); // Trae los estados de PHP
            estadosEnvio.forEach(estado => {
                const estadoDiv = document.getElementById(`estado-${estado.id}`);

                // Verificar si el estado es alcanzado o completado
                if (estado.nombre === data.estadoEnvio) {
                    // Cambiar el color de los íconos hasta el estado actual
                    estadoDiv.style.backgroundColor = '#dc3545'; // Rojo para completados
                    estadoDiv.querySelector('img').style.opacity = '1'; // Asegurar que la imagen sea visible
                } else if (estado.nombre !== data.estadoEnvio && estado.id < data.estadoEnvio) {
                    // Colorear los iconos anteriores (estados previos)
                    estadoDiv.style.backgroundColor = '#dc3545'; // Rojo para completados
                    estadoDiv.querySelector('img').style.opacity = '1'; // Asegurar que la imagen sea visible
                } else {
                    // Los íconos futuros se mantienen en gris
                    estadoDiv.style.backgroundColor = '#ddd'; // Gris para pendientes
                    estadoDiv.querySelector('img').style.opacity = '0.5'; // Reducir la opacidad de los íconos futuros
                }
            });
        } else {
            // Mostrar mensaje de error
            errorMensaje.classList.remove('d-none');
            resultadoPedido.classList.add('d-none');
        }
    });
});

</script>
<script src="vendors/@popperjs/popper.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.min.js"></script>
  <script src="vendors/is/is.min.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="vendors/fontawesome/all.min.js"></script>
  <script src="assets/js/theme.js"></script>  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">
@endsection