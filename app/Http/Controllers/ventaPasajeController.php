<?php

namespace App\Http\Controllers;

use App\Models\VentaPasaje;
use App\Models\Cliente;
use App\Models\Viaje;
use App\Models\Documento;
use Illuminate\Http\Request;
use App\Models\Persona;



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
        // Validar los datos del formulario
        $validated = $request->validate([
            'id_viaje' => 'required|exists:viajes,id',
            'id_cliente' => 'required|exists:clientes,id',
            'costo' => 'required|numeric',
            'fecha_venta' => 'nullable|date',
            'estado' => 'nullable|string|max:15',
            'id_empresa' => 'nullable|exists:clientes,id',
        ]);

        // Crear una nueva venta de pasaje
        VentaPasaje::create($validated);

        return redirect()->route('ventas_pasajes.index')->with('success', 'Venta de pasaje registrada');
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
            'estado' => 'nullable|string|max:15',
            'id_empresa' => 'nullable|exists:clientes,id',
        ]);

        // Actualizar la venta de pasaje
        $ventaPasaje->update($validated);

        return redirect()->route('ventas_pasajes.index')->with('success', 'Venta de pasaje actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VentaPasaje $ventaPasaje)
    {
        // Eliminar la venta de pasaje
        $ventaPasaje->delete();

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

    


    
}
