<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\VentaPasaje;
use App\Models\Encomienda;
use App\Models\Viaje;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\User;

class DashboardController extends Controller
{
    public function obtenerDatosDashboard(Request $request)
{
    // Datos de ventas de pasajes
    $ventas = VentaPasaje::selectRaw('DAYNAME(fecha_venta) as dia_semana, COUNT(*) as total_ventas, SUM(costo) as total_ingresos')
        ->groupBy('dia_semana')
        ->orderByRaw("FIELD(dia_semana, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")  // Ordenar correctamente por los días de la semana
        ->get();

    // Datos de encomiendas
    $encomiendas = Encomienda::selectRaw('DAYNAME(fecha_registro) as dia_semana, COUNT(*) as total_encomiendas, SUM(costo_total) as total_costo_encomiendas')
        ->groupBy('dia_semana')
        ->orderByRaw("FIELD(dia_semana, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")  // Ordenar correctamente por los días de la semana
        ->get();

    // Mapeo de los días de la semana a español
    $diasSemana = [
        'Monday' => 'Lunes',
        'Tuesday' => 'Martes',
        'Wednesday' => 'Miércoles',
        'Thursday' => 'Jueves',
        'Friday' => 'Viernes',
        'Saturday' => 'Sábado',
        'Sunday' => 'Domingo',
    ];

    // Reemplazar los días en inglés por los días en español
    $ventas->transform(function ($venta) use ($diasSemana) {
        $venta->dia_semana = $diasSemana[$venta->dia_semana] ?? $venta->dia_semana;
        return $venta;
    });

    $encomiendas->transform(function ($encomienda) use ($diasSemana) {
        $encomienda->dia_semana = $diasSemana[$encomienda->dia_semana] ?? $encomienda->dia_semana;
        return $encomienda;
    });

    // Obtener clientes no jurídicos (personas)
    $clientesNoJuridicos = Cliente::whereHas('persona', function ($query) {
        $query->where('documento_id', '!=', 2);  // Documentos diferentes a 2, asumiendo que 2 es para empresas
    })->count();

    // Obtener clientes jurídicos (empresas)
    $clientesJuridicos = Cliente::whereHas('persona', function ($query) {
        $query->where('documento_id', '=', 2);  // Documento igual a 2, para empresas
    })->count();

    // Obtener cantidad de vehículos
    $vehiculos = Vehiculo::count();

    // Obtener cantidad de usuarios
    $usuarios = User::count();

    // Datos de estados de los viajes
    $viajes = Viaje::selectRaw('estado, COUNT(*) as total')
        ->groupBy('estado')
        ->get();

    $estadoEncomiendas = Encomienda::selectRaw('estado_envio, COUNT(*) as total')
        ->groupBy('estado_envio')
        ->orderByRaw("FIELD(estado_envio, 'Registrado', 'En Camino', 'Para Recojo', 'Entregado')")
        ->get();


   // Datos de viajes por vehículo
    $viajesPorVehiculo = Viaje::selectRaw('id_vehiculo, COUNT(*) as total_viajes')
        ->groupBy('id_vehiculo')
        ->with('vehiculo')  // Cargar la relación con Vehiculo
        ->get()
        ->map(function ($viaje) {
            return [
                'vehiculo' => $viaje->vehiculo->placa ?? 'Vehículo ID ' . $viaje->id_vehiculo, // Mostrar la placa del vehículo
                'total_viajes' => $viaje->total_viajes
            ];
        });

        return response()->json([
            'success' => true,
            'data' => [
                'ventas' => $ventas,
                'encomiendas' => $encomiendas,
                'estadoEncomiendas' => $estadoEncomiendas,
                'viajes' => $viajes,
                'clientes_no_juridicos' => $clientesNoJuridicos,
                'clientes_juridicos' => $clientesJuridicos,
                'vehiculos' => $vehiculos,
                'usuarios' => $usuarios,
                'viajesPorVehiculo' => $viajesPorVehiculo
            ]
        ]);
    }
}
