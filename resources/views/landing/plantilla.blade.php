<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Transporte Cerna')</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="/public/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <link href="assets/css/theme.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  </head>  

  <body>
    <div class="main" id="top">
      <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: rgba(255, 255, 255, 0.9); box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
        <div class="container">
          <a class="navbar-brand" href="index.html">
            <img src="assets/img/oficial.png" height="50" alt="logo" />
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto align-items-lg-center">
              <li class="nav-item px-3"><a class="nav-link" href="{{ url('/') }}">Inicio</a></li>
              <li class="nav-item px-3"><a class="nav-link" href="{{ url('/nosotros') }}">Nosotros</a></li>
              <li class="nav-item px-3"><a class="nav-link" href="{{ url('/cotización') }}">Cotizaciones</a></li>
              <li class="nav-item px-3"><a class="nav-link" href="{{ route('seguimientos') }}">Seguimiento</a></li>
              <li class="nav-item px-3"><a class="nav-link" href="{{ url('/contactenos') }}">Contactenos</a></li>
              <li class="nav-item px-3">
                <a class="btn btn-outline-white" style="background: #E01A1A; color: white" href="{{ route('login') }}">Ingresar</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      
    </div>
    
    <main>
        @yield('contenido')
    </main>

  <script src="vendors/@popperjs/popper.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.min.js"></script>
  <script src="vendors/is/is.min.js"></script>
  <script src="vendors/fontawesome/all.min.js"></script>
  <script src="assets/js/theme.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">
  </body>
</html>