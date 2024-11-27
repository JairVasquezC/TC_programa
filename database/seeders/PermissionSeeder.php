<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [

            // //categorías
            // 'ver-categoria',
            // 'crear-categoria',
            // 'editar-categoria',
            // 'eliminar-categoria',

            //Cliente
            'ver-cliente',
            'crear-cliente',
            'editar-cliente',
            'eliminar-cliente',

            // //Compra
            // 'ver-compra',
            // 'crear-compra',
            // 'mostrar-compra',
            // 'eliminar-compra',

            // //Marca
            // 'ver-marca',
            // 'crear-marca',
            // 'editar-marca',
            // 'eliminar-marca',

            // //Presentacione
            // 'ver-presentacione',
            // 'crear-presentacione',
            // 'editar-presentacione',
            // 'eliminar-presentacione',

            // //Producto
            // 'ver-producto',
            // 'crear-producto',
            // 'editar-producto',
            // 'eliminar-producto',

            // //Proveedore
            // 'ver-proveedore',
            // 'crear-proveedore',
            // 'editar-proveedore',
            // 'eliminar-proveedore',

            // //Venta
            // 'ver-venta',
            // 'crear-venta',
            // 'mostrar-venta',
            // 'eliminar-venta',

            //Roles
            'ver-role',
            'crear-role',
            'editar-role',
            'eliminar-role',

            //User
            'ver-user',
            'crear-user',
            'editar-user',
            'eliminar-user',

            //Perfil
            'ver-perfil',
            'editar-perfil',

            //Vehiculo
            'ver-vehiculo',
            'crear-vehiculo',
            'editar-vehiculo',
            'eliminar-vehiculo',

            //Viaje
            'ver-viaje',
            'crear-viaje',
            'editar-viaje',
            'eliminar-viaje',
            

            //venta_pasaje
            'ver-venta_pasaje',
            'crear-venta_pasaje',
            'editar-venta_pasaje',
            'eliminar-venta_pasaje',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate([
                'name' => $permiso,
                'guard_name' => 'web', // Especifica el guard si tienes más de uno
            ]);
        }
    }
}
