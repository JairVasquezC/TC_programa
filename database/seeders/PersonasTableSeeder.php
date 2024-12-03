<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Persona;
use App\Models\Documento;

class PersonasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 8 clientes particulares
        for ($i = 0; $i < 8; $i++) {
            $personaParticular = Persona::create([
                'razon_social' => 'Particular ' . ($i + 1),
                'direccion' => 'Dirección Particular ' . ($i + 1),
                'tipo_persona' => 'Particular',
                'documento_id' => 1, // Suponiendo que '1' es el ID de 'DNI'
                'numero_documento' => rand(10000000, 99999999) // Genera un número de documento aleatorio
            ]);

            Cliente::create([
                'persona_id' => $personaParticular->id
            ]);
        }

        // Crear 7 clientes empresas
        for ($i = 0; $i < 7; $i++) {
            $personaEmpresa = Persona::create([
                'razon_social' => 'Empresa ' . ($i + 1) . ' S.A.C.',
                'direccion' => 'Dirección Empresa ' . ($i + 1),
                'tipo_persona' => 'Empresa',
                'documento_id' => 2, // Suponiendo que '2' es el ID de 'RUC'
                'numero_documento' => rand(10000000000, 99999999999) // Genera un número de RUC aleatorio
            ]);

            Cliente::create([
                'persona_id' => $personaEmpresa->id
            ]);
        }
    }
}
