<?php

namespace App\Http\Controllers;

use App\Models\VentaPasaje;
use App\Models\Encomienda;
use App\Models\Viaje;
use Illuminate\Http\Request;

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

    // Datos de estados de los viajes
    $viajes = Viaje::selectRaw('estado, COUNT(*) as total')
        ->groupBy('estado')
        ->get();

    return response()->json([
        'ventas' => $ventas,
        'encomiendas' => $encomiendas,
        'viajes' => $viajes,
    ]);
}
}
