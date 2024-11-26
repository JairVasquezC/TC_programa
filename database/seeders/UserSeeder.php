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
    }
}
