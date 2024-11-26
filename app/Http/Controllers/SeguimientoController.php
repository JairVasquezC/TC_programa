<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    public function index()
    {
        $estadosEnvio = [
            ['id' => 1, 'nombre' => 'Pedido Registrado', 'imagen' => 'assets/img/p_registrado.png'],
            ['id' => 2, 'nombre' => 'Pedido en Camino', 'imagen' => 'assets/img/p_camino.png'],
            ['id' => 3, 'nombre' => 'Pedido para Recojo', 'imagen' => 'assets/img/p_recojo.png'],
            ['id' => 4, 'nombre' => 'Pedido Entregado', 'imagen' => 'assets/img/p_entregado.png'],
        ];

        $pedidosFicticios = [
            ['codigo' => '111', 'dni' => '11111111', 'estadoActual' => 3, 'descripcion' => 'Pedido de electrodomésticos grandes con entrega programada.'],
            ['codigo' => '222', 'dni' => '22222222', 'estadoActual' => 1, 'descripcion' => 'Pedido de muebles.'],
        ];

        return view('secciones/seguimiento', compact('estadosEnvio', 'pedidosFicticios'));
    }
}
