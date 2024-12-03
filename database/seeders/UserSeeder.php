<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verifica si el rol 'chofer' ya existe, lo crea si no
        $rolChofer = Role::firstOrCreate(['name' => 'chofer']);

        // Obtener todos los permisos disponibles y asignarlos al rol 'chofer' (opcional, si los choferes deben tener permisos)
        $permisos = Permission::pluck('id', 'id')->all();
        $rolChofer->syncPermissions($permisos);

        // Crear el primer usuario chofer
        $user1 = User::firstOrCreate(
            ['email' => 'chofer1@example.com'], // Buscar por email
            [
                'name' => 'Chofer Uno',
                'password' => Hash::make('12345678') // Asegura que la contraseña esté encriptada
            ]
        );

        // Crear el segundo usuario chofer
        $user2 = User::firstOrCreate(
            ['email' => 'chofer2@example.com'], // Buscar por email
            [
                'name' => 'Chofer Dos',
                'password' => Hash::make('12345678') // Asegura que la contraseña esté encriptada
            ]
        );

        
        // Verifica si el usuario existe y lo crea solo si no está en la base de datos
        $user = User::firstOrCreate(
            ['email' => 'luz@gmail.com'], // Buscar por email
            [
                'name' => 'Luz Solano',
                'password' => Hash::make('12345678') // Asegura que la contraseña esté encriptada
            ]
        );

        // Verifica si el rol 'administrador' ya existe, lo crea si no
        $rol = Role::firstOrCreate(['name' => 'administrador']);

        // Obtener todos los permisos disponibles
        $permisos = Permission::pluck('id', 'id')->all();
        $rol->syncPermissions($permisos); // Asignar permisos al rol

        // Asignar el rol al usuario (si no está asignado)
        if (!$user->hasRole('administrador')) {
            $user->assignRole($rol);
        }

        // Asignar el rol 'chofer' al primer usuario si no lo tiene
        if (!$user1->hasRole('chofer')) {
            $user1->assignRole($rolChofer);
        }

        // Asignar el rol 'chofer' al segundo usuario si no lo tiene
        if (!$user2->hasRole('chofer')) {
            $user2->assignRole($rolChofer);
        }
    }
}
