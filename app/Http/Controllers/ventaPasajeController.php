<?php

namespace App\Http\Controllers;

use App\Models\VentaPasaje;
use App\Models\Cliente;
use App\Models\Viaje;
use Illuminate\Http\Request;

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
        return view('ventas_pasajes.create', compact('viajes', 'clientes'));
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
}
