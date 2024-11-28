<?php

namespace App\Http\Controllers;

use App\Models\VentaPasaje;
use App\Models\Cliente;
use App\Models\Viaje;
use App\Models\Documento;
use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class ventaPasajeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-venta_pasaje|crear-venta_pasaje|editar-venta_pasaje|eliminar-venta_pasaje', ['only' => ['index']]);
        $this->middleware('permission:crear-venta_pasaje', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-venta_pasaje', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-venta_pasaje', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las ventas de pasajes con las relaciones de viaje, cliente y empresa
        $ventasPasajes = VentaPasaje::with('viaje', 'cliente', 'empresa')->get();
        return view('ventas_pasajes.index', compact('ventasPasajes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener los viajes y clientes disponibles para crear una venta de pasaje
        $viajes = Viaje::all();
        $clientes = Cliente::all();
        $documentos = Documento::all();
        return view('ventas_pasajes.create', compact('viajes', 'clientes','documentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Datos recibidos:', $request->all());

        // Validar los datos recibidos
        $validated = $request->validate([
            'tipo_cliente' => 'required|string|in:natural,juridica',
            'id_cliente' => 'required|integer',
            'viaje_id' => 'required|integer',
            'costo' => 'required|numeric|min:0',
            'estado' => 'required|string|in:transferencia,credito,efectivo,yape_plin',
        ]);

        // Determinar el valor de id_empresa
        $id_empresa = $request->tipo_cliente === 'natural' ? null : $request->id_empresa;

        // Crear el registro
        $venta = new VentaPasaje();
        $venta->id_viaje = $validated['viaje_id'];
        $venta->id_cliente = $validated['id_cliente'];
        $venta->costo = $validated['costo'];
        $venta->fecha_venta = Carbon::now();
        $venta->estado = $validated['estado'];
        $venta->id_empresa = $id_empresa; // Null si tipo_cliente es natural
        $venta->save();

        // Responder al cliente
        return redirect()->route('ventas_pasajes.index')->with('success', 'Venta de pasaje creada exitosamente.');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VentaPasaje $ventaPasaje)
    {
        // Obtener los viajes y clientes disponibles para actualizar la venta
        $viajes = Viaje::all();
        $clientes = Cliente::all();
        return view('ventas_pasajes.edit', compact('ventaPasaje', 'viajes', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VentaPasaje $ventaPasaje)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'id_viaje' => 'required|exists:viajes,id',
            'id_cliente' => 'required|exists:clientes,id',
            'costo' => 'required|numeric',
            'fecha_venta' => 'nullable|date',
            'estado' => 'nullable|string',
            'id_empresa' => 'nullable|exists:clientes,id',
        ]);

        // Actualizar la venta de pasaje
        $ventaPasaje->update($validated);

        return redirect()->route('ventas_pasajes.index')->with('success', 'Venta de pasaje actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VentaPasaje $ventas_pasaje)
    {
        Log::info($ventas_pasaje);
        // Eliminar la venta de pasaje
        $ventas_pasaje->delete();

        return redirect()->route('ventas_pasajes.index')->with('success', 'Venta de pasaje eliminada');
    }

    public function buscarClientePorDni(Request $request)
    {
        try {
            // Validación de entrada
            $request->validate(['dni' => 'required|string']);

            // Buscar persona por DNI
            $persona = Persona::where('numero_documento', $request->dni)->first();

            // Si no se encuentra la persona
            if (!$persona) {
                return response()->json([
                    'success' => false,
                    'message' => 'Persona no encontrada',
                ], 404);
            }

            // Si la persona no tiene cliente asociado
            if (!$persona->cliente) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cliente no asociado a esta persona',
                ], 404);
            }

            // Verificar relación con documento
            $tipoDocumento = $persona->documento->tipo_documento ?? 'Desconocido';

            // Preparar datos para retornar
            $clienteData = [
                'id' => $persona->id,
                'nombre' => $persona->razon_social,
                'tipo_documento' => $tipoDocumento,
                'numero_documento' => $persona->numero_documento,
                'direccion' => $persona->direccion,
            ];

            return response()->json([
                'success' => true,
                'data' => $clienteData,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor',
            ], 500);
        }
    }

    public function boleta($id)
    {
        // Recuperamos la venta de pasaje con todas las relaciones necesarias
        $venta = VentaPasaje::with(['cliente.persona', 'viaje.vehiculo', 'empresa.persona'])->findOrFail($id);

        // Datos del cliente
        $cliente = $venta->cliente->persona;
        $tipo_cliente = ($cliente->tipo_persona == 'juridico') ? $venta->empresa->persona->razon_social : $cliente->razon_social;
        $documento_cliente = $cliente->numero_documento;

        // Datos del viaje
        $viaje = $venta->viaje;
        $vehiculo = $viaje->vehiculo;

        // Fecha de la venta
        $fecha_venta = $venta->fecha_venta;
        $costo = $venta->costo;

        // Generación de la boleta en PDF
        $pdf = \PDF::loadView('boletas.pasaje', compact('venta', 'tipo_cliente', 'documento_cliente', 'viaje', 'vehiculo', 'fecha_venta', 'costo'));

        // Retorna el PDF generado para su descarga
        return $pdf->download('boleta_venta_pasaje_' . $venta->id . '.pdf');
    }

}
