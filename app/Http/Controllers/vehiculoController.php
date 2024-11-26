<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class vehiculoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-vehiculo|crear-vehiculo|editar-vehiculo|eliminar-vehiculo', ['only' => ['index']]);
        $this->middleware('permission:crear-vehiculo', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-vehiculo', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-vehiculo', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los vehículos
        $vehiculos = Vehiculo::all();
        return view('vehiculo.index', compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar el formulario para crear un nuevo vehículo
        return view('vehiculo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'placa' => 'required|string|max:10|unique:vehiculos,placa',
            'tipo' => 'required|string|max:20',
            'capacidad_peso' => 'nullable|numeric|min:0',
            'capacidad_personas' => 'required|integer|min:1',
        ]);

        // Crear el vehículo
        Vehiculo::create($validated);

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo registrado exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculo $vehiculo)
    {
        // Mostrar el formulario para editar un vehículo
        return view('vehiculo.edit', compact('vehiculo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'placa' => 'required|string|max:10|unique:vehiculos,placa,' . $vehiculo->id,
            'tipo' => 'required|string|max:20',
            'capacidad_peso' => 'nullable|numeric|min:0',
            'capacidad_personas' => 'required|integer|min:1',
        ]);

        // Actualizar el vehículo
        $vehiculo->update($validated);

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        // Eliminar el vehículo
        $vehiculo->delete();

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado exitosamente');
    }
}
