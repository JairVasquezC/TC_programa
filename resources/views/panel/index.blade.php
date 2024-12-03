@extends('layouts.app')

@section('title','Panel')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    /* Ajustar el tamaño del gráfico de pastel */
    canvas#viajesChart {
        max-width: 100%;  /* Ajusta el ancho del gráfico */
        width: 100%;      /* Define que ocupe todo el contenedor */
        height: 300px;    /* Ajusta la altura del gráfico */
    }
</style>
@endpush

@section('content')

@if (session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let message = "{{ session('success') }}";
        Swal.fire(message);
    });
</script>
@endif

<div class="container-fluid px-4 py-3">
    <h3 class="mt-4 text-black text-center">Vista de Panel</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"></li>
    </ol>
    <div class="row">
        <!-- Clientes Jurídicos -->
        <div class="col-xl-3 col-md-3">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-building"></i><span class="m-1">Empresas</span>
                        </div>
                        <div class="col-4">
                            <p id="clientesJuridicos" class="text-center fw-bold fs-4">...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Clientes No Jurídicos -->
        <div class="col-xl-3 col-md-3">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-user"></i><span class="m-1">Clientes</span>
                        </div>
                        <div class="col-4">
                            <p id="clientesNoJuridicos" class="text-center fw-bold fs-4">...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Vehículos -->
        <div class="col-xl-3 col-md-3">
            <div class="card bg-info text-white mb-4">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-car"></i><span class="m-1">Vehículos</span>
                        </div>
                        <div class="col-4">
                            <p id="vehiculos" class="text-center fw-bold fs-4">...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Usuarios -->
        <div class="col-xl-3 col-md-3">
            <div class="card bg-success text-white mb-4">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-users"></i><span class="m-1">Usuarios</span>
                        </div>
                        <div class="col-4">
                            <p id="usuarios" class="text-center fw-bold fs-4">...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="row mt-5">
        <div class="col-md-6">
            <canvas id="ventasChart" class="p-2"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="encomiendasChart" class="p-2"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="viajesChart" class="p-2"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="viajesPorVehiculoChart" class="p-2"></canvas>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
<script>
    // Función para obtener los datos del dashboard desde el backend
    function obtenerDatosDashboard() {
        fetch('/api/dashboard/datos') // Ruta que te devolverá los datos en formato JSON
            .then(response => response.json())
            .then(data => {
                // Actualizar los datos en las tarjetas
                document.getElementById('clientesJuridicos').textContent = data.data.clientes_juridicos;
                document.getElementById('clientesNoJuridicos').textContent = data.data.clientes_no_juridicos;
                document.getElementById('vehiculos').textContent = data.data.vehiculos;
                document.getElementById('usuarios').textContent = data.data.usuarios;

                // Actualizar los gráficos
                actualizarGraficos(data);
            });
    }

    // Función para actualizar los gráficos con los datos obtenidos
    function actualizarGraficos(data) {
        // Gráfico de ventas
        new Chart(document.getElementById('ventasChart'), {
            type: 'line',
            data: {
                labels: data.data.ventas.map(venta => venta.dia_semana),  // Usar los días de la semana
                datasets: [{
                    label: 'Total Ventas',
                    data: data.data.ventas.map(venta => venta.total_ventas),
                    borderColor: '#007bff',
                    fill: false,
                }]
            }
        });

        // Gráfico de encomiendas
        new Chart(document.getElementById('encomiendasChart'), {
            type: 'bar',
            data: {
                labels: data.data.encomiendas.map(encomienda => encomienda.dia_semana),  // Usar los días de la semana
                datasets: [{
                    label: 'Costo Total Encomiendas',
                    data: data.data.encomiendas.map(encomienda => encomienda.total_costo_encomiendas),
                    backgroundColor: '#28a745',
                }]
            }
        });

        // Gráfico de estados de envío de encomiendas
        new Chart(document.getElementById('viajesChart'), {  // Cambia el ID si lo deseas
            type: 'bar',  // Cambia de 'pie' a 'bar'
            data: {
                labels: data.data.estadoEncomiendas.map(encomienda => encomienda.estado_envio), // Muestra los estados de envío en el eje X
                datasets: [{
                    label: 'Estados de Envío de Encomiendas',
                    data: data.data.estadoEncomiendas.map(encomienda => encomienda.total), // Cantidad de encomiendas por estado
                    backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6c757d'], // Colores de las barras
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Estado de Envío' // Etiqueta del eje X
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Número de Encomiendas' // Etiqueta del eje Y
                        },
                        ticks: {
                            beginAtZero: true // Comenzar desde cero
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Ocultar la leyenda si es innecesaria
                    }
                }
            }
        });

        // Gráfico de viajes por vehículo
        new Chart(document.getElementById('viajesPorVehiculoChart'), {
            type: 'bar',
            data: {
                labels: data.data.viajesPorVehiculo.map(viaje => viaje.vehiculo), // Vehículos
                datasets: [{
                    label: 'Viajes por Vehículo',
                    data: data.data.viajesPorVehiculo.map(viaje => viaje.total_viajes), // Total de viajes
                    backgroundColor: '#007bff',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Vehículo'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Número de Viajes'
                        }
                    }
                }
            }
        });
    }

    // Obtener los datos al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        obtenerDatosDashboard();
    });
</script>
@endpush
