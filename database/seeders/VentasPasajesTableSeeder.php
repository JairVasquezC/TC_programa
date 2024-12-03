<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VentaPasaje;
use App\Models\Viaje;
use App\Models\Cliente;
use Carbon\Carbon;

class VentasPasajesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Obtener clientes con tipo de documento diferente a 2 (personas)
         $clientesParticulares = Cliente::whereHas('persona', function ($query) {
            $query->where('documento_id', '!=', 2);
        })->get();

        // Obtener clientes con tipo de documento igual a 2 (empresas)
        $clientesEmpresas = Cliente::whereHas('persona', function ($query) {
            $query->where('documento_id', '=', 2);
        })->get();

        // Obtener viajes disponibles (aseguramos que hay viajes para seleccionar)
        $viajes = Viaje::all();

        // Verificar que haya clientes y viajes disponibles
if ($clientesParticulares->isEmpty() || $clientesEmpresas->isEmpty() || $viajes->isEmpty()) {
    $mensaje = 'No hay suficientes datos para llenar la tabla de ventas.';

    // Verificar cuál de los conjuntos está vacío y agregar más detalle al mensaje
    if ($clientesParticulares->isEmpty()) {
        $mensaje .= ' No hay clientes particulares disponibles.';
    }

    if ($clientesEmpresas->isEmpty()) {
        $mensaje .= ' No hay clientes empresas disponibles.';
    }

    if ($viajes->isEmpty()) {
        $mensaje .= ' No hay viajes disponibles.';
    }

    // Mostrar el mensaje detallado
    $this->command->info($mensaje);
    return;
}

        // Crear 20 ventas de pasajes
        for ($i = 0; $i < 20; $i++) {
            // Seleccionar un cliente particular aleatorio
            $clienteParticular = $clientesParticulares->random();

            // Seleccionar un viaje aleatorio para este cliente
            $viaje = $viajes->random();

            // Determinar si se asigna una empresa (tipo de documento 2)
            $empresa = rand(0, 1) ? $clientesEmpresas->random() : null;

            // Crear la venta de pasaje
            VentaPasaje::create([
                'id_viaje' => $viaje->id, // Viaje relacionado
                'id_cliente' => $clienteParticular->id, // Cliente particular
                'costo' => rand(50, 300), // Costo aleatorio
                'fecha_venta' => Carbon::now()->subDays(rand(0, 30)), // Fecha de venta aleatoria en los últimos 30 días
                'estado' => 'pagado', // Estado de la venta
                'id_empresa' => $empresa ? $empresa->id : null, // Asignar empresa si existe
            ]);
        }

        $this->command->info('La tabla de ventas_pasajes se ha llenado correctamente.');
    }
}
