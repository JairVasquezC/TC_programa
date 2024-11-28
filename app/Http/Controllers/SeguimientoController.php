<?php

namespace App\Http\Controllers;

use App\Models\Encomienda;
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

        return view('secciones/seguimiento', compact('estadosEnvio'));
    }
    public function buscarPedido(Request $request)
    {
        // Valida los datos
    $validated = $request->validate([
        'codigo' => 'required|string',
        'dni' => 'required|string',
    ]);

    // Busca la encomienda
    $encomienda = Encomienda::where('id', $validated['codigo'])
        ->whereHas('remitente.persona', function($query) use ($validated) {
            $query->where('numero_documento', $validated['dni']);
        })
        ->first();

    if ($encomienda) {
        return response()->json([
            'success' => true,
            'estadoEnvio' => $encomienda->estado_envio,
            'fecha_registro'=>$encomienda->fecha_registro
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'No se encontró el pedido con los datos ingresados.',
        ]);
    }
    }
}
