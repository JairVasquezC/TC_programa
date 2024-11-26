@extends('landing.plantilla')

@section('title', 'Transporte Cerna')

@section('contenido')

 <!-- Carrusel -->
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
    <h2 class="text-center mb-4">Cotización de Encomiendas</h2>
    <p class="text-center mb-5">
        Calcule el costo de su encomienda ingresando las características del envío. 
        Seleccione si se trata de un paquete o sobre e indique las dimensiones correspondientes.
    </p>

    <form id="cotizacionForm" class="bg-white p-4 shadow rounded">
        <!-- Tipo de Encomienda -->
        <div class="mb-4">
            <h4 style="color: #E01A1A">Tipo de Encomienda</h4>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="tipoEncomienda" id="paquete" value="paquete">
                <label for="paquete" class="form-check-label">Paquete</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="tipoEncomienda" id="sobre" value="sobre">
                <label for="sobre" class="form-check-label">Sobre</label>
            </div>
        </div>

        <!-- Dimensiones -->
        <div id="dimensiones" class="d-none">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="peso" class="form-label">Peso (kg)</label>
                    <input type="number" id="peso" class="form-control" placeholder="Peso en kilogramos">
                </div>
                <div class="col-md-6">
                    <label for="ancho" class="form-label">Ancho (cm)</label>
                    <input type="number" id="ancho" class="form-control" placeholder="Ancho en centímetros">
                </div>
                <div class="col-md-6">
                    <label for="largo" class="form-label">Largo (cm)</label>
                    <input type="number" id="largo" class="form-control" placeholder="Largo en centímetros">
                </div>
                <div id="grosorGroup" class="col-md-6 d-none">
                    <label for="grosor" class="form-label">Grosor (cm)</label>
                    <input type="number" id="grosor" class="form-control" placeholder="Grosor en centímetros">
                </div>
            </div>
        </div>

        <!-- Botón -->
        <div class="mt-4 text-center">
            <button type="button" id="calcularBtn" class="btn btn-danger text-white" style="background: #E01A1A">
                Calcular Costo
            </button>
        </div>

        <!-- Resultado -->
        <div id="costoResultado" class="mt-4 text-center text-danger fw-bold d-none">
            Costo Estimado: <span id="costo">S/ 0.00</span>
        </div>
    </form>

    <!-- Derechos Reservados -->

  
</div>
<div class="text-center py-3" style="background-color: #E01A1A;">
    <p class="mb-0 text-white">© 2024 Cerna - Todos los derechos reservados.</p>
  </div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tipoEncomiendaInputs = document.querySelectorAll('input[name="tipoEncomienda"]');
        const dimensionesDiv = document.getElementById('dimensiones');
        const grosorGroup = document.getElementById('grosorGroup');
        const calcularBtn = document.getElementById('calcularBtn');
        const costoResultado = document.getElementById('costoResultado');
        const costoSpan = document.getElementById('costo');

        let tipoEncomienda = "";
        
        tipoEncomiendaInputs.forEach(input => {
            input.addEventListener('change', () => {
                tipoEncomienda = input.value;
                dimensionesDiv.classList.remove('d-none');
                grosorGroup.classList.toggle('d-none', tipoEncomienda === "sobre");
            });
        });

        calcularBtn.addEventListener('click', () => {
            const peso = parseFloat(document.getElementById('peso').value) || 0;
            const ancho = parseFloat(document.getElementById('ancho').value) || 0;
            const largo = parseFloat(document.getElementById('largo').value) || 0;
            const grosor = parseFloat(document.getElementById('grosor').value) || 0;

            let volumen = 0;
            let costoBase = 0;

            if (tipoEncomienda === "sobre") {
                volumen = ancho * largo;
                costoBase = 5;
            } else if (tipoEncomienda === "paquete") {
                volumen = ancho * largo * grosor;
                costoBase = 10;
            }

            const costoFinal = costoBase + peso * 2 + volumen * 0.01;
            costoSpan.textContent = `S/ ${costoFinal.toFixed(2)}`;
            costoResultado.classList.remove('d-none');
        });
    });
</script>
<link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
<link rel="manifest" href="assets/img/favicons/manifest.json">
<meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
<meta name="theme-color" content="#ffffff">
@section('contenido')

  <script src="vendors/@popperjs/popper.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.min.js"></script>
  <script src="vendors/is/is.min.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="vendors/fontawesome/all.min.js"></script>
  <script src="assets/js/theme.js"></script>  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">

@endsection