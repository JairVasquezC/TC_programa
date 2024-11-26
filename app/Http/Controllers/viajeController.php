<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class viajeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-viaje|crear-viaje|editar-viaje|eliminar-viaje', ['only' => ['index']]);
        $this->middleware('permission:crear-viaje', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-viaje', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-viaje', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los viajes con las relaciones con chofer y vehículo
        $viajes = Viaje::with('chofer', 'vehiculo')->get();
        return view('viaje.index', compact('viajes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener los choferes y vehículos disponibles para asignar
        $choferes = User::where('role', 'chofer')->get(); // Asegúrate de que los choferes tienen un rol definido
        $vehiculos = Vehiculo::all();
        return view('viaje.create', compact('choferes', 'vehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|time',
            'id_chofer' => 'nullable|exists:users,id',
            'id_vehiculo' => 'nullable|exists:vehiculos,id',
            'estado' => 'nullable|string|max:15',
        ]);

        // Crear el viaje
        Viaje::create($validated);

        return redirect()->route('viajes.index')->with('success', 'Viaje creado exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Viaje $viaje)
    {
        // Obtener choferes y vehículos disponibles
        $choferes = User::where('role', 'chofer')->get(); // Asegúrate de que los choferes tienen un rol definido
        $vehiculos = Vehiculo::all();
        return view('viaje.edit', compact('viaje', 'choferes', 'vehiculos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Viaje $viaje)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|time',
            'id_chofer' => 'nullable|exists:users,id',
            'id_vehiculo' => 'nullable|exists:vehiculos,id',
            'estado' => 'nullable|string|max:15',
        ]);

        // Actualizar el viaje
        $viaje->update($validated);

        return redirect()->route('viajes.index')->with('success', 'Viaje actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Viaje $viaje)
    {
        // Eliminar el viaje
        $viaje->delete();

        return redirect()->route('viajes.index')->with('success', 'Viaje eliminado exitosamente');
    }
}
