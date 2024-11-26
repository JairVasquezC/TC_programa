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
<style>
  .btn-custom {
    background-color: #A61818;  /* Color de fondo */
    border-color: #A61818;      /* Color de borde */
}

.btn-custom:hover {
    background-color: #8E1414;  /* Color al pasar el ratón */
    border-color: #8E1414;
}

</style>

@section('contenido')

  <section style="padding-top: 7rem;">
    <div class="bg-holder" style="background-image:url(assets/img/hero/hero-bg.svg);">
    </div> 
 
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-5 col-lg-6 order-0 order-md-1 text-end"><img class="pt-7 pt-md-0 hero-img" src="assets/img/hero/hero-img.png" alt="hero-header" /></div>
        <div class="col-md-7 col-lg-6 text-md-start text-center py-6">
          <h4 class="fw-bold mb-3"style="color: #A61818;">¡Todo lo que necesitas, a un clic de distancia!</h4>
          <h1 class="hero-title" style="font-size: 60px" >Viajes y envíos rápidos y muy seguros</h1>
          <p class="mb-4 fw-medium " style="color: black ; font-size: 15px">Tu tranquilidad es nuestra prioridad. Con nuestra plataforma, todo es más fácil y accesible.Porque tu satisfacción es lo primero
          <div class="text-center text-md-start"> 
                  <a class="btn btn-lg me-md-4 mb-3 mb-md-0 border-0 primary-btn-shadow" 
                      href="#!" role="button" 
                      style="background-color: #A61818; border-color: white;color: white">
                      Ver Más
                  </a>
          </div>
        </div>
      </div>
    </div>
  </section>
 
  {{-- <section id="booking">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="text-start">
            
            <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Book your next trip in 3 easy steps</h3>
          </div>
          <div class="d-flex align-items-start mb-5">
            <div class="bg-primary me-sm-4 me-3 p-3" style="border-radius: 13px"> <img src="assets/img/steps/selection.svg" width="22" alt="steps" /></div>
            <div class="flex-1">
              <h5 class="text-secondary fw-bold fs-0">Choose Destination</h5>
              <p>Choose your favourite place. No matter <br class="d-none d-sm-block"> where you travel inside the World.</p>
            </div>
          </div>
          <div class="d-flex align-items-start mb-5">
            <div class="bg-danger me-sm-4 me-3 p-3" style="border-radius: 13px"> <img src="assets/img/steps/water-sport.svg" width="22" alt="steps" /></div>
            <div class="flex-1">
              <h5 class="text-secondary fw-bold fs-0">Make Payment</h5>
              <p>After find your perfect spot, make your <br class="d-none d-sm-block"> payment and get ready to travel.</p>
            </div>
          </div>
          <div class="d-flex align-items-start mb-5">
            <div class="bg-info me-sm-4 me-3 p-3" style="border-radius: 13px"> <img src="assets/img/steps/taxi.svg" width="22" alt="steps" /></div>
            <div class="flex-1">
              <h5 class="text-secondary fw-bold fs-0">Reach Airport on Selected Date</h5>
              <p>Lastly, you have to arrive at the airport <br class="d-none d-sm-block"> on time and enjoy the vacation.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 d-flex justify-content-center align-items-start">
          <div class="card position-relative shadow" style="max-width: 370px;">
            <div class="position-absolute z-index--1 me-10 me-xxl-0" style="right:-160px;top:-210px;"> <img src="assets/img/steps/bg.png" style="max-width:550px;" alt="shape" /></div>
            <div class="card-body p-3"> <img class="mb-4 mt-2 rounded-2 w-100" src="assets/img/steps/booking-img.jpg" alt="booking" />
              <div>
                <h5 class="fw-medium">Trip To Greece</h5>
                <p class="fs--1 mb-3 fw-medium">14-29 June | by Robbin joseph</p>
                <div class="icon-group mb-4"> <span class="btn icon-item"> <img src="assets/img/steps/leaf.svg" alt=""/></span><span class="btn icon-item"> <img src="assets/img/steps/map.svg" alt=""/></span><span class="btn icon-item"> <img src="assets/img/steps/send.svg" alt=""/></span>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                  <div class="d-flex align-items-center mt-n1"><img class="me-3" src="assets/img/steps/building.svg" width="18" alt="building" /><span class="fs--1 fw-medium">24 people going</span></div>
                  <div class="show-onhover position-relative">
                    <div class="card hideEl shadow position-absolute end-0 start-xl-50 bottom-100 translate-xl-middle-x ms-3" style="width: 260px;border-radius:18px;">
                      <div class="card-body py-3">
                        <div class="d-flex">
                          <div style="margin-right: 10px"> <img class="rounded-circle" src="assets/img/steps/favorite-placeholder.png" width="50" alt="favorite" /></div>
                          <div>
                            <p class="fs--1 mb-1 fw-medium">Ongoing </p>
                            <h5 class="fw-medium mb-3">Trip to rome</h5>
                            <h6 class="fs--1 fw-medium mb-2"><span>40%</span> completed</h6>
                            <div class="progress" style="height: 6px;">
                              <div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button class="btn"> <img src="assets/img/steps/heart.svg" width="20" alt="step" /></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- end of .container-->

  </section> --}}


  <section id="booking">
    <div class="container">
      <div class="row align-items-center text-center">
          <h2>Por Qué Elegirnos</h2>
          <p>Contamos con años de experiencia, un equipo comprometido y los recursos adecuados para brindarte soluciones rápidas, eficientes y seguras que superen tus expectativas</p>
        <!-- Columna izquierda con los pasos -->
        <div class="mt-4 col-12 d-flex justify-content-between">
          <div class="d-flex align-items-start mb-4 ">
            <div class="bg-primary me-sm-4 me-3 p-3" style="border-radius: 13px"> 
              <img src="assets/img/steps/selection.svg" width="22" alt="steps" />
            </div>
            <div class="flex-1 mt-3">
              <p>Clientes satisfechos</p>
        
            </div>
          </div>
          <div class="d-flex align-items-start mb-5">
            <div class="bg-danger me-sm-4 me-3 p-3" style="border-radius: 13px"> 
              <img src="assets/img/steps/water-sport.svg" width="22" alt="steps" />
            </div>
            <div class="flex-1 mt-3">
              <hp>Flota Propia</p>
            </div>
          </div>
          <div class="d-flex align-items-start mb-5">
            <div class="bg-info me-sm-4 me-3 p-3" style="border-radius: 13px"> 
              <img src="assets/img/steps/taxi.svg" width="22" alt="steps" />
            </div>
            <div class="flex-1 mt-3">
              <hp>Innovación Tecnológica</p>
            </div>
          </div>
        </div>
        <!-- Eliminar columna derecha con la imagen -->
      </div>
    </div>
  </section>
  

  <div class="container py-0">
    <!-- Fila para el video y estadísticas -->
    <div class="row justify-content-center align-items-center">
        <!-- Columna para el video -->
        <div class="col-md-6">
            <div class="video-container">
                <video class="w-100" src="assets/video/Cerna.mp4" autoplay loop muted controls></video>
            </div>
        </div>

        <!-- Columna para las estadísticas -->
        <div class="col-md-6">
            <div class="text-center">
                <h2>Nuestra Experiencia</h2>
                <p class="mb-4 text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi corporis nulla doloribus dolorum ipsum dolore iure dolores unde. </p>
                <div class="row">
                    <!-- Estadística 1 -->
                    <div class="col-6">
                        <h3 id="stat1" class="display-4">0</h3>
                        <p>Clientes satisfechos</p>
                    </div>
                    <!-- Estadística 2 -->
                    <div class="col-6">
                        <h3 id="stat2" class="display-4">0</h3>
                        <p>Envíos completados</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <!-- Estadística 3 -->
                    <div class="col-6">
                        <h3 id="stat3" class="display-4">0</h3>
                        <p>Choferes capacitados</p>
                    </div>
                    <!-- Estadística 4 -->
                    <div class="col-6">
                        <h3 id="stat4" class="display-4">0</h3>
                        <p>Vehículos en operación</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <section class="pt-md-6" id="service">
    <div class="container">
      <div class="position-absolute z-index--1 end-0 d-none d-lg-block">
        <img src="assets/img/category/shape.svg" style="max-width: 200px" alt="service" />
      </div>
      <div class="mb-2 text-center mt-6">
        <h2>Nuestros Servicios</h2>
        <p>Contamos con un equipo comprometido con la satisfacción del cliente, siempre enfocado en ofrecer lo mejor y garantizar una experiencia excepcional.</p>
      </div>
      <div class="row">
        <!-- Columna izquierda con los 4 servicios -->
        <div class="col-lg-6 col-12 mb-4">
          <div class="d-flex flex-column align-items-start">
            <!-- Servicio 1: Logística -->
            <div class="d-flex align-items-center service-card shadow-hover rounded-3 p-4 mb-3">
              <i class="fas fa-truck me-4" style="font-size: 55px; color: #E01A1A;"></i>
              <div>
                <h4>Logística Corporativa</h4>
                <p class="mb-0" style="text-align: justify">Optimiza la cadena de suministro adaptándose al cliente de acuerdo.</p>
              </div>
            </div>
            <!-- Servicio 2: Encomiendas -->
            <div class="d-flex align-items-center service-card shadow-hover rounded-3 p-4 mb-3">
              <i class="fas fa-box-open me-4" style="font-size: 55px; color: #E01A1A;"></i>
              <div>
                <h4>Encomiendas</h4>
                <p class="mb-0" style="text-align: justify">Envío de mercancías competitivo, con entrega segura y puntual garantizada.</p>
              </div>
            </div>
            <!-- Servicio 3: Pasajes -->
            <div class="d-flex align-items-center service-card shadow-hover rounded-3 p-4 mb-3">
              <i class="fas fa-ticket-alt me-4" style="font-size: 55px; color: #E01A1A;"></i>
              <div>
                <h4>Pasajes</h4>
                <p class="mb-0" style="text-align: justify">Emisión rápida de pasajes, opciones flexibles y servicio al cliente excelente.</p>
              </div>
            </div>
            <!-- Servicio 4: Transporte Terrestre -->
            <div class="d-flex align-items-center service-card shadow-hover rounded-3 p-4 mb-3">
              <i class="fas fa-bus me-4" style="font-size: 55px; color: #E01A1A;"></i>
              <div>
                <h4>Transporte Terrestre</h4>
                <p class="mb-0" style="text-align: justify">Transporte seguro y eficiente, para encomiendas y pasajeros.</p>
              </div>
            </div>
          </div>
        </div>
    
        <!-- Columna derecha con la imagen grande -->
        <div class="col-lg-6 col-12">
          <div class="d-flex justify-content-center align-items-center">
            <img src="assets/img/joven.jpg" alt="Imagen de servicio" style="width: 90%; height: 90%; object-fit: cover;">
          </div>
        </div>
      </div>
    </div>
  </section>
  
  

  {{-- <section class="pt-5" id="destination">
    <div class="container">
      <div class="position-absolute start-100 bottom-0 translate-middle-x d-none d-xl-block ms-xl-n4"><img src="assets/img/dest/shape.svg" alt="destination" /></div>
      <div class="mb-7 text-center">
        <h5 class="text-secondary">Top Selling </h5>
        <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Top Destinations</h3>
      </div>
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="card overflow-hidden shadow"> <img class="card-img-top" src="assets/img/dest/dest1.jpg" alt="Rome, Italty" />
            <div class="card-body py-4 px-3">
              <div class="d-flex flex-column flex-lg-row justify-content-between mb-3">
                <h4 class="text-secondary fw-medium"><a class="link-900 text-decoration-none stretched-link" href="#!">Rome, Italty</a></h4><span class="fs-1 fw-medium">$5,42k</span>
              </div>
              <div class="d-flex align-items-center"> <img src="assets/img/dest/navigation.svg" style="margin-right: 14px" width="20" alt="navigation" /><span class="fs-0 fw-medium">10 Days Trip</span></div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card overflow-hidden shadow"> <img class="card-img-top" src="assets/img/dest/dest2.jpg" alt="London, UK" />
            <div class="card-body py-4 px-3">
              <div class="d-flex flex-column flex-lg-row justify-content-between mb-3">
                <h4 class="text-secondary fw-medium"><a class="link-900 text-decoration-none stretched-link" href="#!">London, UK</a></h4><span class="fs-1 fw-medium">$4.2k</span>
              </div>
              <div class="d-flex align-items-center"> <img src="assets/img/dest/navigation.svg" style="margin-right: 14px" width="20" alt="navigation" /><span class="fs-0 fw-medium">12 Days Trip</span></div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card overflow-hidden shadow"> <img class="card-img-top" src="assets/img/dest/dest3.jpg" alt="Full Europe" />
            <div class="card-body py-4 px-3">
              <div class="d-flex flex-column flex-lg-row justify-content-between mb-3">
                <h4 class="text-secondary fw-medium"><a class="link-900 text-decoration-none stretched-link" href="#!">Full Europe</a></h4><span class="fs-1 fw-medium">$15k</span>
              </div>
              <div class="d-flex align-items-center"> <img src="assets/img/dest/navigation.svg" style="margin-right: 14px" width="20" alt="navigation" /><span class="fs-0 fw-medium">28 Days Trip</span></div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- end of .container-->

  </section> --}}
  
  
  
  {{-- <section id="testimonial">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="mb-8 text-start">
            <h5 class="text-secondary">Testimonials </h5>
            <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">What people say about Us.</h3>
          </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-6">
          <div class="pe-7 ps-5 ps-lg-0">
            <div class="carousel slide carousel-fade position-static" id="testimonialIndicator" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button class="active" type="button" data-bs-target="#testimonialIndicator" data-bs-slide-to="0" aria-current="true" aria-label="Testimonial 0"></button>
                <button class="false" type="button" data-bs-target="#testimonialIndicator" data-bs-slide-to="1" aria-current="true" aria-label="Testimonial 1"></button>
                <button class="false" type="button" data-bs-target="#testimonialIndicator" data-bs-slide-to="2" aria-current="true" aria-label="Testimonial 2"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item position-relative active">
                  <div class="card shadow" style="border-radius:10px;">
                    <div class="position-absolute start-0 top-0 translate-middle"> <img class="rounded-circle fit-cover" src="assets/img/testimonial/author.png" height="65" width="65" alt="" /></div>
                    <div class="card-body p-4">
                      <p class="fw-medium mb-4">&quot;On the Windows talking painted pasture yet its express parties use. Sure last upon he same as knew next. Of believed or diverted no.&quot;</p>
                      <h5 class="text-secondary">Mike taylor</h5>
                      <p class="fw-medium fs--1 mb-0">Lahore, Pakistan</p>
                    </div>
                  </div>
                  <div class="card shadow-sm position-absolute top-0 z-index--1 mb-3 w-100 h-100" style="border-radius:10px;transform:translate(25px, 25px)"> </div>
                </div>
                <div class="carousel-item position-relative ">
                  <div class="card shadow" style="border-radius:10px;">
                    <div class="position-absolute start-0 top-0 translate-middle"> <img class="rounded-circle fit-cover" src="assets/img/testimonial/author2.png" height="65" width="65" alt="" /></div>
                    <div class="card-body p-4">
                      <p class="fw-medium mb-4">&quot;Jadoo is recognized as one of the finest travel agency in the world. When it came to planning a trip, I found them to be dependable.&quot;</p>
                      <h5 class="text-secondary">Thomas Wagon</h5>
                      <p class="fw-medium fs--1 mb-0">CEO of Red Button</p>
                    </div>
                  </div>
                  <div class="card shadow-sm position-absolute top-0 z-index--1 mb-3 w-100 h-100" style="border-radius:10px;transform:translate(25px, 25px)"> </div>
                </div>
                <div class="carousel-item position-relative ">
                  <div class="card shadow" style="border-radius:10px;">
                    <div class="position-absolute start-0 top-0 translate-middle"> <img class="rounded-circle fit-cover" src="assets/img/testimonial/author3.png" height="65" width="65" alt="" /></div>
                    <div class="card-body p-4">
                      <p class="fw-medium mb-4">&quot;On the Windows talking painted pasture yet its express parties use. Sure last upon he same as knew next. Of believed or diverted no.&quot;</p>
                      <h5 class="text-secondary">Kelly Willium</h5>
                      <p class="fw-medium fs--1 mb-0">Khulna, Bangladesh</p>
                    </div>
                  </div>
                  <div class="card shadow-sm position-absolute top-0 z-index--1 mb-3 w-100 h-100" style="border-radius:10px;transform:translate(25px, 25px)"> </div>
                </div>
              </div>
              <div class="carousel-navigation d-flex flex-column flex-between-center position-absolute end-0 top-lg-50 bottom-0 translate-middle-y z-index-1 me-3 me-lg-0" style="height:60px;width:20px;">
                <button class="carousel-control-prev position-static" type="button" data-bs-target="#testimonialIndicator" data-bs-slide="prev"><img src="assets/img/icons/up.svg" width="16" alt="icon" /></button>
                <button class="carousel-control-next position-static" type="button" data-bs-target="#testimonialIndicator" data-bs-slide="next"><img src="assets/img/icons/down.svg" width="16" alt="icon" /></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- end of .container-->

  </section> --}}

  {{-- <div class="position-relative pt-9 pt-lg-8 pb-6 pb-lg-8">
    <div class="container">
      <div class="row row-cols-lg-5 row-cols-md-3 row-cols-2 flex-center">
        <div class="col">
          <div class="card shadow-hover mb-4" style="border-radius:10px;">
            <div class="card-body text-center"> <img class="img-fluid" src="assets/img/partner/1.png" alt="" /></div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-hover mb-4" style="border-radius:10px;">
            <div class="card-body text-center"> <img class="img-fluid" src="assets/img/partner/2.png" alt="" /></div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-hover mb-4" style="border-radius:10px;">
            <div class="card-body text-center"> <img class="img-fluid" src="assets/img/partner/3.png" alt="" /></div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-hover mb-4" style="border-radius:10px;">
            <div class="card-body text-center"> <img class="img-fluid" src="assets/img/partner/4.png" alt="" /></div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-hover mb-4" style="border-radius:10px;">
            <div class="card-body text-center"> <img class="img-fluid" src="assets/img/partner/5.png" alt="" /></div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}


  {{-- <section class="pt-6">
    <div class="container">
      <div class="py-8 px-5 position-relative text-center" style="background-color: rgba(223, 215, 249, 0.199);border-radius: 129px 20px 20px 20px;">
        <div class="position-absolute start-100 top-0 translate-middle ms-md-n3 ms-n4 mt-3"> <img src="assets/img/cta/send.png" style="max-width:70px;" alt="send icon" /></div>
        <div class="position-absolute end-0 top-0 z-index--1"> <img src="assets/img/cta/shape-bg2.png" width="264" alt="cta shape" /></div>
        <div class="position-absolute start-0 bottom-0 ms-3 z-index--1 d-none d-sm-block"> <img src="assets/img/cta/shape-bg1.png" style="max-width: 340px;" alt="cta shape" /></div>
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-10">
            <h2 class="text-secondary lh-1-7 mb-7">Subscribe to get information, latest news and other interesting offers about Cobham</h2>
            <form class="row g-3 align-items-center w-lg-75 mx-auto">
              <div class="col-sm">
                <div class="input-group-icon">
                  <input class="form-control form-little-squirrel-control" type="email" placeholder="Enter email " aria-label="email" /><img class="input-box-icon" src="assets/img/cta/mail.svg" width="17" alt="mail" />
                </div>
              </div>
              <div class="col-sm-auto">
                <button class="btn btn-danger orange-gradient-btn fs--1">Subscribe</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div><!-- end of .container-->

  </section> --}}

  
  {{-- <section class="py-4" style="background: #E01A1A">
    <div class="container">
      <div class="row" style="color: black">
       
        <div class="col-md-3 col-12 mb-4 mb-md-0">
          <div class="d-flex flex-column align-items-center">
            <img src="assets/img/logo_blanco-copia.png" alt="Cerna Logo" width="150" class="mb-3">
           
          </div>
        </div>
  
        
        <div class="col-md-3 col-6 mb-4 mb-md-0">
          <h5 class="mb-3" style="color: white">Empresa</h5>
          <ul class="list-unstyled">
            <li><a href="#" style="color: black">Quiénes Somos</a></li>
            <li><a href="#" style="color: black">Contáctanos</a></li>
          </ul>
        </div>
  
       
        <div class="col-md-3 col-6 mb-4 mb-md-0">
          <h5 class="mb-3" style="color: white">Encomiendas</h5>
          <ul class="list-unstyled">
            <li><a href="#" style="color: black">Cotizaciones</a></li>
            <li><a href="#" style="color: black">Flota de Cargueros</a></li>
          </ul>
        </div>
  
      
        <div class="col-md-3 col-6 mb-4 mb-md-0">
          <h5 class="mb-3" style="color: white">Personal</h5>
          <ul class="list-unstyled">
            <li><a href="#" style="color: black">Cotizaciones</a></li>
            <li><a href="#" style="color: black">Flota de Camionetas</a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
   --}}
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
  <script>
    // Función para animar los contadores
    function animateCount(id, target, duration) {
        let start = 0;
        const increment = target / (duration / 10); // Incremento por frame (10ms)
        const element = document.getElementById(id);

        const timer = setInterval(() => {
            start += increment;
            if (start >= target) {
                start = target;
                clearInterval(timer); // Detener animación al llegar al objetivo
            }
            element.textContent = Math.floor(start); // Actualizar el texto
        }, 10);
    }

    // Ejecutar las animaciones al cargar la página
    document.addEventListener("DOMContentLoaded", () => {
        animateCount("stat1", 750, 2000); // Clientes satisfechos: 250 en 2s
        animateCount("stat2", 500, 2000); // Envíos completados: 500 en 2s
        animateCount("stat3", 10, 2000);  // Choferes capacitados: 75 en 2s
        animateCount("stat4", 15, 2000); // Vehículos en operación: 120 en 2s
    });
  </script>
@endsection