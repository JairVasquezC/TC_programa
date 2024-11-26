@extends('landing.plantilla')

@section('title', 'Transporte Cerna')
<link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
<link rel="manifest" href="assets/img/favicons/manifest.json">
<meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
<meta name="theme-color" content="#ffffff">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@section('contenido')


    <!-- Imagen de portada -->
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

    <!-- Título -->

    <div class="text-center">
        <h2 class="mt-4">Contáctanos</h2>
        <p >Estamos aquí para ayudarte con cualquier duda o consulta.</p>
    </div>
    <!-- Preguntas Frecuentes -->
    <section class="mb-1 text-align-center" >
        <h3  style="text-align: center">Preguntas Frecuentes</h3>
        <div class="row">
            @foreach ([
                ['pregunta' => '¿Cómo puedo realizar un seguimiento de mi envío?', 'respuesta' => 'Puedes ingresar el número de rastreo en la sección de seguimiento en nuestra página principal.'],
                ['pregunta' => '¿Cuáles son los tiempos de entrega promedio?', 'respuesta' => 'Los tiempos de entrega varían según la distancia y el tipo de envío, generalmente entre 1 a 5 días hábiles.'],
                ['pregunta' => '¿Qué tipos de encomiendas aceptan?', 'respuesta' => 'Aceptamos sobres, paquetes pequeños y grandes, sujetos a nuestras políticas de transporte.'],
                ['pregunta' => '¿Qué hacer si mi encomienda no ha llegado?', 'respuesta' => 'Puedes contactarnos directamente al WhatsApp o correo para verificar el estado de tu envío.']
            ] as $faq)
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <p>{{ $faq['pregunta'] }}</p>
                        <p class="card-text text-muted">{{ $faq['respuesta'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Ubicación -->
    <section class="mb-4">
        <h3 style="text-align: center">Nuestra Ubicación</h3><br><br>
        <div class="row align-items-center">
            <!-- Mapa -->
            <div class="col-lg-6 mb-lg-0">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5805.510577573364!2d-79.00751047852145!3d-8.097373099097!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91ad163cfd0d1a99%3A0xf23c77572a7b8690!2sTransportes%20CERNA%20SRL.!5e0!3m2!1ses!2spe!4v1732101859532!5m2!1ses!2spe"
                    width="100%"
                    height="300"
                    style="border: 0;"
                    allowfullscreen=""
                    loading="lazy"
                    title="Ubicación"
                ></iframe>
            </div>
            <!-- Dirección -->
            <div class="col-lg-6">
                <p>
                    📍 Calle Ejemplo 123, Distrito X, Ciudad Y, País Z.
                </p>
                <p class="text-muted">Horario de atención: Lunes a Viernes de 9:00 AM a 6:00 PM.</p>
            </div>
        </div>
    </section>

    <!-- Redes Sociales -->
    {{-- <section class="text-center">
        <h3 class="text-danger fw-bold mb-4">Síguenos en Redes Sociales</h3>
        <div class="d-flex justify-content-center gap-4">
            <a href="https://wa.me/1234567890" target="_blank" class="text-success fs-1">
                <i class="bi bi-whatsapp"></i>
            </a>
            <a href="https://facebook.com/tuempresa" target="_blank" class="text-primary fs-1">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="https://instagram.com/tuempresa" target="_blank" class="text-danger fs-1">
                <i class="bi bi-instagram"></i>
            </a>
        </div>
    </section> --}}
</div>
<!-- Derechos Reservados -->
<div class="text-center py-3" style="background-color: #E01A1A;">
    <p class="mb-0 text-white">© 2024 Cerna - Todos los derechos reservados.</p>
  </div>
<script src="vendors/@popperjs/popper.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.min.js"></script>
  <script src="vendors/is/is.min.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="vendors/fontawesome/all.min.js"></script>
  <script src="assets/js/theme.js"></script>  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">
@endsection