@extends('landing.plantilla')

@section('title', 'Transporte Cerna')
<link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
<link rel="manifest" href="assets/img/favicons/manifest.json">
<meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
<meta name="theme-color" content="#ffffff">
<link href="assets/css/theme.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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

  <!-- Saludo del Gerente -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class=" mt-4 text-center">
        <div class="w-16 h-1 bg-danger mx-auto mb-4"></div>
        <h2 class=" mb-6 ">Nuestros Servicios</h2>
      </div>
      <div class="row align-items-center">
        <div class="col-md-6">
          <h2 class="text-3xl font-semibold text-dark">Gerente General</h2>
          <p class="mt-4 text-dark text-justify" style="font-weight: 200; font-size: 14px">
            En <strong>Transportes Cerna S.R.L.</strong>, nuestra prioridad es ofrecer soluciones
            confiables y eficientes para satisfacer las necesidades de nuestros clientes. 
            Estamos comprometidos con la excelencia y la innovación, buscando siempre superar 
            las expectativas. ¡Gracias por confiar en nosotros como su socio estratégico!
          </p>
          <p class="mt-4 text-gray-600 font-semibold" style="font-weight: 200; font-size: 14px">- Pablo Cerna Medina, Gerente General</p>
        </div>
        <div class="col-md-6 text-center">
          <img src="assets/img/gerente02.jpg" alt="Gerente General" class="rounded-circle shadow-lg" style="width: 250px; height: 250px; object-fit: cover;">
        </div>
      </div>
    </div>
  </section>

  <!-- Descripción de Transportes Cerna -->
  <section class="py-5 text-white" style="background: #E01A1A" >
    <div class="container" style="background: #E01A1A">
      <div class="row align-items-center">
        <div class="col-md-6 text-center">
            <img src="assets/img/empresa.jpg" alt="Transportes Cerna" class="rounded-circle" style="width: 240px; height: 240px; object-fit: cover; border: 3px solid #6c757d;">
          </div>
        <div class="col-md-6">
          <div class="w-16 h-1 bg-white mx-auto mb-4"></div>
          <h2 class="text-3xl font-bold" style="color: white">Transportes Cerna S.R.L</h2>
          <p class="mt-4 text-justify" style="font-weight: 200; font-size: 14px">
            Desde nuestros inicios, en <strong>Transportes Cerna S.R.L.</strong>, nos hemos dedicado a ofrecer
            servicios de transporte y logística confiables y seguros. Gracias a nuestra experiencia, 
            flota moderna y equipo altamente capacitado, garantizamos soluciones que se adaptan a las 
            necesidades de nuestros clientes. Nuestro compromiso es seguir creciendo y mejorando para 
            liderar el sector de transporte y logística.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Misión y Visión -->
  <section class="py-8 bg-light">
    <div class="container">
      <div class="row">
        <!-- Misión -->
        <div class="col-md-6">
          <div class="card">
            <img src="assets/img/mision.jpg" alt="Misión" class="card-img-top" style="height: 200px; object-fit: cover;">
            <div class="card-body">
              <h5 class="card-title text-xl font-semibold text-dark">Nuestra Misión</h5>
              <p class="card-text text-dark text-justify" style="font-weight: 200; font-size: 14px">
                Ofrecer servicios de transporte y logística de alta calidad, garantizando la 
                seguridad, puntualidad y satisfacción de nuestros clientes, mientras promovemos 
                un ambiente laboral ético y responsable con el medio ambiente.
              </p>
            </div>
          </div>
        </div>
        <!-- Visión -->
        <div class="col-md-6">
          <div class="card">
            <img src="assets/img/vision.jpg" alt="Visión" class="card-img-top" style="height: 200px; object-fit: cover;">
            <div class="card-body">
              <h5 class="card-title text-xl font-semibold text-dark">Nuestra Visión</h5>
              <p class="card-text text-dark text-justify" style="font-weight: 200; font-size: 14px">
                Ser reconocidos como líderes en el sector de transporte y logística a nivel nacional, 
                destacándonos por nuestra innovación, tecnología avanzada y compromiso con el desarrollo 
                sostenible y compromiso con el desarrollo .
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Trabajadores -->
  <section class="py-4 bg-light">
    <div class="container text-center">
      <h2 class="text-3xl font-semibold text-dark mb-4">Nuestro Equipo</h2>
      <div class="row row-cols-2 row-cols-md-4">
        <div class="col mb-4">
          <img src="assets/img/trabajador01.jpg" alt="Trabajador 1" class="img-fluid rounded-lg shadow-md" style="width: 100%; height: 200px; object-fit: cover;">
        </div>
        <div class="col mb-4">
          <img src="assets/img/trabajador02.jpg" alt="Trabajador 2" class="img-fluid rounded-lg shadow-md" style="width: 100%; height: 200px; object-fit: cover;">
        </div>
        <div class="col mb-4">
          <img src="assets/img/trabajdor03.jpg" alt="Trabajador 3" class="img-fluid rounded-lg shadow-md" style="width: 100%; height: 200px; object-fit: cover;">
        </div>
        <div class="col mb-4">
          <img src="assets/img/trabajador04.jpg" alt="Trabajador 4" class="img-fluid rounded-lg shadow-md" style="width: 100%; height: 200px; object-fit: cover;">
        </div>
        <div class="col mb-4">
          <img src="assets/img/trabajador05.jpg" alt="Trabajador 5" class="img-fluid rounded-lg shadow-md" style="width: 100%; height: 200px; object-fit: cover;">
        </div>
        <div class="col mb-4">
          <img src="assets/img/trabajador06.jpg" alt="Trabajador 6" class="img-fluid rounded-lg shadow-md" style="width: 100%; height: 200px; object-fit: cover;">
        </div>
        <div class="col mb-4">
          <img src="assets/img/trabajador07.jpg" alt="Trabajador 7" class="img-fluid rounded-lg shadow-md" style="width: 100%; height: 200px; object-fit: cover;">
        </div>
        <div class="col mb-4">
          <img src="assets/img/trabajador08.jpg" alt="Trabajador 8" class="img-fluid rounded-lg shadow-md" style="width: 100%; height: 200px; object-fit: cover;">
        </div>
      </div>
    </div>
  </section>
  <!-- Derechos Reservados -->
  <div class="text-center py-3" style="background-color: #E01A1A;">
    <p class="mb-0 text-white">© 2024 Cerna - Todos los derechos reservados.</p>
  </div>
  
</div>

<script src="vendors/@popperjs/popper.min.js"></script>
<script src="vendors/bootstrap/bootstrap.min.js"></script>
<script src="vendors/is/is.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
<script src="vendors/fontawesome/all.min.js"></script>
<script src="assets/js/theme.js"></script>  
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">
@endsection