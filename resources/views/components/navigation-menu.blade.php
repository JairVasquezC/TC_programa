<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-red" id="sidenavAccordion">
        <div class="sb-sidenav-menu text-white">
            <div class="nav">

                <div class="sb-sidenav-menu-heading">Inicio</div>
                <a class="nav-link text-white" href="{{ route('panel') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Panel
                </a>

                <!---div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Layouts
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="layout-static.html">Static Navigation</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="login.html">Login</a>
                                <a class="nav-link" href="register.html">Register</a>
                                <a class="nav-link" href="password.html">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="401.html">401 Page</a>
                                <a class="nav-link" href="404.html">404 Page</a>
                                <a class="nav-link" href="500.html">500 Page</a>
                            </nav>
                        </div>
                    </nav>
                </div--->

                <div class="sb-sidenav-menu-heading text-white">Modulos</div>

                {{-- <!----Compras---->
                @can('ver-compra')
                <a class="nav-link collapsed text-white" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCompras" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-store"></i></div>
                    Compras
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCompras" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav text-white">
                        @can('ver-compra')
                        <a class="nav-link text-white" href="{{ route('compras.index') }}">Listado de Compras</a>
                        @endcan
                        @can('crear-compra')
                        <a class="nav-link text-white" href="{{ route('compras.create') }}">Registrar Compra</a>
                        @endcan
                    </nav>
                </div>
                @endcan --}}

                <!----Ventas---->
                {{-- @can('ver-venta')
                <a class="nav-link collapsed text-white" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVentas" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                    Ventas
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseVentas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @can('ver-venta')
                        <a class="nav-link text-white" href="{{ route('ventas.index') }}">Lista de Ventas</a>
                        @endcan
                        @can('crear-compra')
                        <a class="nav-link text-white" href="{{ route('ventas.create') }}">Registrar Venta</a>
                        @endcan
                    </nav>
                </div>
                @endcan

                @can('ver-categoria')
                <a class="nav-link text-white" href="{{ route('categorias.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-tag"></i></div>
                    Categorías
                </a>
                @endcan

                @can('ver-presentacione')
                <a class="nav-link text-white" href="{{ route('presentaciones.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-box-archive"></i></div>
                    Presentaciones
                </a>
                @endcan

                @can('ver-marca')
                <a class="nav-link text-white" href="{{ route('marcas.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-bullhorn"></i></div>
                    Marcas
                </a>
                @endcan

                @can('ver-producto')
                <a class="nav-link text-white" href="{{ route('productos.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-brands fa-shopify"></i></div>
                    Productos
                </a>
                @endcan --}}

                @can('ver-cliente')
                <a class="nav-link text-white" href="{{ route('clientes.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                    Clientes
                </a>
                @endcan

                @can('ver-vehiculo')
                <a class="nav-link text-white" href="{{ route('vehiculos.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-car"></i></div>
                    Vehículos
                </a>
                @endcan

                @can('ver-viaje')
                <a class="nav-link text-white" href="{{ route('viajes.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-road"></i></div>
                    Viajes
                </a>
                @endcan

                @can('ver-venta_pasaje')
                <a class="nav-link text-white" href="{{ route('ventas_pasajes.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-ticket"></i></div>
                    Venta de Pasajes
                </a>
                @endcan
                @can('ver-venta_pasaje')
                <a class="nav-link text-white" href="{{ route('encomiendas.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-box"></i></div>
                    Encomiendas
                </a>
                @endcan

                {{-- @can('ver-proveedore')
                <a class="nav-link text-white" href="{{ route('proveedores.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-group"></i></div>
                    Proveedores
                </a>
                @endcan --}}

                @hasrole('administrador')
                <div class="sb-sidenav-menu-heading">OTROS</div>
                @endhasrole

                @can('ver-user')
                <a class="nav-link text-white" href="{{ route('users.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Usuarios
                </a>
                @endcan

                @can('ver-role')
                <a class="nav-link text-white" href="{{ route('roles.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-person-circle-plus"></i></div>
                    Roles
                </a>
                @endcan


            </div>
        </div>
        {{-- <div class="sb-sidenav-footer">
            <div class="small">Bienvenido:</div>
            {{ auth()->user()->name }}
        </div> --}}
    </nav>
</div>
