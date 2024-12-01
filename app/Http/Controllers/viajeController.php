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
        // Verificar si el rol 'chofer' existe
        if (!User::role('chofer')->exists()) {
            return redirect()->route('viajes.index')->with('error', 'El rol chofer no existe. Por favor, crea el rol antes de continuar.');
        }
        // Obtener los choferes con el rol 'chofer'
        $choferes = User::role('chofer')->get();

        if ($choferes->isEmpty()) {
            return redirect()->route('viajes.index')->with('error', 'No hay choferes disponibles para asignar.');
        }

         // Obtener los vehículos
        $vehiculos = Vehiculo::all();

        if ($vehiculos->isEmpty()) {
            return redirect()->route('viajes.index')->with('error', 'No hay vehículos disponibles para asignar.');
        }

        return view('viaje.create', compact('choferes', 'vehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'fecha' => 'required',
            'hora' => 'required',
            'id_chofer' => 'nullable|exists:users,id',
            'id_vehiculo' => 'nullable|exists:vehiculos,id',
        ]);

        // Asignar automáticamente el estado "Viaje Registrado"
        $validated['estado'] = 'Viaje Registrado';

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
        $choferes = User::role('chofer')->get(); // Asegúrate de que los choferes tienen un rol definido
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
            'fecha' => 'required',
            'hora' => 'required',
            'id_chofer' => 'nullable|exists:users,id',
            'id_vehiculo' => 'nullable|exists:vehiculos,id',
            'estado' => 'nullable|string',
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

    public function actualizarEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|string|in:Viaje Registrado,Viaje en camino,Viaje Finalizado',
        ]);

        $viaje = Viaje::findOrFail($id);
        $viaje->estado = $request->estado;
        $viaje->save();

        // Actualizar el estado de las encomiendas asociadas
        $nuevoEstadoEncomienda = null;
        switch ($viaje->estado) {
            case 'Viaje Registrado':
                $nuevoEstadoEncomienda = 'Pedido Registrado';
                break;
            case 'Viaje en camino':
                $nuevoEstadoEncomienda = 'Pedido en camino';
                break;
            case 'Viaje Finalizado':
                $nuevoEstadoEncomienda = 'Pedido para recojo';
                break;
        }

        if ($nuevoEstadoEncomienda) {
            $viaje->encomiendas()->update(['estado_envio' => $nuevoEstadoEncomienda]);
        }

        return response()->json(['success' => true]);
    }
}
