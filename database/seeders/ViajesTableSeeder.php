<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Viaje;
use App\Models\User;
use App\Models\Vehiculo;
use Carbon\Carbon;
class ViajesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Obtener choferes y vehículos aleatorios
         $choferes = User::role('chofer')->pluck('id')->toArray(); // Obtiene IDs de usuarios con rol chofer
         $vehiculos = Vehiculo::pluck('id')->toArray();            // Obtiene IDs de vehículos
 
         // Si no hay choferes o vehículos, detener el seeder
         if (empty($choferes) || empty($vehiculos)) {
             $this->command->info('No hay choferes o vehículos disponibles.');
             return;
         }
 
         // Crear viajes ficticios
         for ($i = 1; $i <= 10; $i++) {
             Viaje::create([
                 'fecha' => Carbon::today()->addDays(rand(0, 30)),     // Fecha entre hoy y 30 días después
                 'hora' => Carbon::now()->addHours(rand(0, 12))->format('H:i:s'), // Hora aleatoria
                 'id_chofer' => $choferes[array_rand($choferes)],        // Chofer aleatorio
                 'id_vehiculo' => $vehiculos[array_rand($vehiculos)],  // Vehículo aleatorio
                 'estado' => ['Registrado', 'En Camino', 'Finalizado'][rand(0, 2)], // Estado aleatorio
             ]);
         }
 
         $this->command->info('Viajes creados con éxito.');
    }
}
