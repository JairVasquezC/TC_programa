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
        <!-- Clientes -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-people-group"></i><span class="m-1">Clientes</span>
                        </div>
                        <div class="col-4">
                            <?php
                            use App\Models\Cliente;
                            $clientes = count(Cliente::all());
                            ?>
                            <p class="text-center fw-bold fs-4">{{$clientes}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('clientes.index') }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Usuarios -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-user"></i><span class="m-1">Usuarios</span>
                        </div>
                        <div class="col-4">
                            <?php
                            use App\Models\User;
                            $users = count(User::all());
                            ?>
                            <p class="text-center fw-bold fs-4">{{$users}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('users.index') }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
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
        <div class="col-md-4">
            <canvas id="viajesChart" class="p-2"></canvas>
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
                actualizarGraficos(data);
            });
    }

    // Función para actualizar los gráficos con los datos obtenidos
    function actualizarGraficos(data) {
        // Gráfico de ventas
        new Chart(document.getElementById('ventasChart'), {
            type: 'line',
            data: {
                labels: data.ventas.map(venta => venta.dia_semana),  // Usar los días de la semana
                datasets: [{
                    label: 'Total Ventas',
                    data: data.ventas.map(venta => venta.total_ventas),
                    borderColor: '#007bff',
                    fill: false,
                }]
            }
        });

        // Gráfico de encomiendas
        new Chart(document.getElementById('encomiendasChart'), {
            type: 'bar',
            data: {
                labels: data.encomiendas.map(encomienda => encomienda.dia_semana),  // Usar los días de la semana
                datasets: [{
                    label: 'Costo Total Encomiendas',
                    data: data.encomiendas.map(encomienda => encomienda.total_costo_encomiendas),
                    backgroundColor: '#28a745',
                }]
            }
        });

        // Gráfico de viajes
        new Chart(document.getElementById('viajesChart'), {
            type: 'pie',
            data: {
                labels: data.viajes.map(viaje => viaje.estado),
                datasets: [{
                    label: 'Estados de Viaje',
                    data: data.viajes.map(viaje => viaje.total),
                    backgroundColor: ['#ffc107', '#28a745', '#dc3545'],
                }]
            },
            options: {
                responsive: true,
                aspectRatio: 1,  // Ajusta la relación de aspecto
            }
        });
    }

    // Obtener los datos al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        obtenerDatosDashboard();
    });
</script>
@endpush
