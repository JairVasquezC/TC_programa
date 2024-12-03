<?php

namespace Database\Seeders;

use App\Models\Paquete;
use Illuminate\Database\Seeder;
use App\Models\Encomienda;
use App\Models\Cliente;
use App\Models\Viaje;
use Carbon\Carbon;

class PaquetesEncomiendasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Obtener clientes con tipo de documento diferente a 2 (personas)
        $clientesPersonas = Cliente::whereHas('persona', function ($query) {
            $query->where('documento_id', '!=', 2);
        })->get();

        // Obtener clientes con tipo de documento igual a 2 (empresas)
        $clientesEmpresas = Cliente::whereHas('persona', function ($query) {
            $query->where('documento_id', '=', 2);
        })->get();

        // Obtener viajes disponibles
        $viajes = Viaje::all();

        // Verificar que haya clientes y viajes disponibles
        if ($clientesPersonas->isEmpty() || $clientesEmpresas->isEmpty() || $viajes->isEmpty()) {
            $mensaje = 'No hay suficientes datos para llenar la tabla de encomiendas y paquetes.';

            // Verificar cuál de los conjuntos está vacío y agregar más detalle al mensaje
            if ($clientesPersonas->isEmpty()) {
                $mensaje .= ' No hay clientes personas disponibles.';
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

        // Crear 20 encomiendas
        for ($i = 0; $i < 20; $i++) {
            // Seleccionar un remitente y un destinatario aleatorios (clientes personas)
            $remitente = $clientesPersonas->random();
            $destinatario = $clientesPersonas->random();

            // Determinar si se asigna un viaje
            $viaje = rand(0, 1) ? $viajes->random() : null;

            // Seleccionar una empresa aleatoria (clientes empresas) o null
            $empresa = rand(0, 1) ? $clientesEmpresas->random() : null;

            // Definir el estado_envio de la encomienda según el estado del viaje
            if ($viaje) {
                switch ($viaje->estado) {
                    case 'Registrado':
                        $estadoEnvio = 'Registrado';
                        break;
                    case 'En Camino':
                        $estadoEnvio = 'En Camino';
                        break;
                    case 'Finalizado':
                        $estadoEnvio = rand(0, 1) ? 'Para Recojo' : 'Entregado'; // Aleatorio entre "Para Recojo" o "Entregado"
                        break;
                }
            }

            // Crear la encomienda
            $encomienda = Encomienda::create([
                'estado_envio' => $estadoEnvio,
                'fecha_registro' => Carbon::now()->subDays(rand(0, 30)),
                'id_remitente' => $remitente->id,
                'id_destinatario' => $destinatario->id,
                'id_viaje' => $viaje->id,
                'id_empresa' => $empresa ? $empresa->id : null, // Asignar empresa si existe
            ]);

            // Crear los paquetes de forma masiva
            $paquetesData = [];
            $totalCostoPaquetes = 0;
            $numPaquetes = rand(1, 3);
            for ($j = 0; $j < $numPaquetes; $j++) {
                $costoPaquete = rand(50, 200);
                $paquetesData[] = [
                    'descripcion' => 'Paquete ' . $j . ' para la encomienda ' . $encomienda->id,
                    'dimension_ancho' => rand(10, 50),
                    'dimension_largo' => rand(50, 100),
                    'dimension_grosor' => rand(5, 20),
                    'peso' => rand(1, 10),
                    'costo' => $costoPaquete,
                    'id_encomienda' => $encomienda->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                $totalCostoPaquetes += $costoPaquete;
            }

            // Insertar paquetes masivamente
            Paquete::insert($paquetesData);

            // Actualizar el costo total de la encomienda
            $encomienda->update([
                'costo_total' => $totalCostoPaquetes,
            ]);
        }

        $this->command->info('Las tablas de encomiendas y paquetes se han llenado correctamente con el costo total de las encomiendas.');
    }
}
