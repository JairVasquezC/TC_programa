<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehiculo;

class VehiculosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehiculo::create([
            'placa' => 'ABC123',
            'tipo' => 'Camión',
            'capacidad_peso' => 15000.50,
            'capacidad_personas' => 2,
        ]);

        Vehiculo::create([
            'placa' => 'XYZ456',
            'tipo' => 'Camioneta',
            'capacidad_peso' => 1400.00,
            'capacidad_personas' => 4,
        ]);

        Vehiculo::create([
            'placa' => 'DEF789',
            'tipo' => 'Camioneta',
            'capacidad_peso' => 1200.00,
            'capacidad_personas' => 4,
        ]);
    }
}
