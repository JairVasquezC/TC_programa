<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encomienda;
use App\Models\Cliente;
use App\Models\Documento;
use App\Models\Viaje;
use App\Models\Paquete;

class encomiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $encomiendas = Encomienda::with(['remitente', 'destinatario', 'viaje', 'empresa', 'paquetes'])->get();
        return view('encomiendas.index', compact('encomiendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $clientes = Cliente::with('persona')->get();
        $viajes = Viaje::all();
        $documentos = Documento::all();
        return view('encomiendas.create', compact('viajes', 'clientes','documentos'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Crear la encomienda
    $encomienda = Encomienda::create([
        'estado_envio' => $request->estado_envio,
        'id_remitente' => $request->id_remitente,
        'id_destinatario' => $request->id_destinatario,
        'id_viaje' => $request->id_viaje,
        'costo_total' => $request->costo_total, // Guardamos el costo total
    ]);

    // Verificar si hay paquetes y almacenarlos
    $paquetes = $request->input('paquetes');
    if (!empty($paquetes)) {
        foreach ($paquetes as $paquete) {
            $encomienda->paquetes()->create([
                'descripcion' => $paquete['descripcion'],
                'dimension_ancho' => $paquete['dimension_ancho'],
                'dimension_largo' => $paquete['dimension_largo'],
                'dimension_grosor' => $paquete['dimension_grosor'],
                'peso' => $paquete['peso'],
                'costo' => $paquete['peso'] * 10, // Ejemplo de costo
            ]);
        }
    }

    return redirect()->route('encomiendas.index')->with('success', 'Encomienda registrada correctamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $encomienda = Encomienda::with(['remitente', 'destinatario', 'viaje', 'empresa', 'paquetes'])->find($id);

        if (!$encomienda) {
            return redirect()->route('encomiendas.index')->with('error', 'Encomienda no encontrada');
        }

        return view('encomiendas.show', compact('encomienda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $encomienda = Encomienda::find($id);
        $clientes = Cliente::all();
        $viajes = Viaje::all();

        if (!$encomienda) {
            return redirect()->route('encomiendas.index')->with('error', 'Encomienda no encontrada');
        }

        return view('encomiendas.edit', compact('encomienda', 'clientes', 'viajes'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $encomienda = Encomienda::find($id);

        if (!$encomienda) {
            return redirect()->route('encomiendas.index')->with('error', 'Encomienda no encontrada');
        }

        $validatedData = $request->validate([
            'costo_total' => 'required|numeric',
            'estado_envio' => 'nullable|string|max:15',
            'id_remitente' => 'required|exists:clientes,id',
            'id_destinatario' => 'required|exists:clientes,id',
            'id_viaje' => 'nullable|exists:viajes,id',
            'id_empresa' => 'nullable|exists:clientes,id',
        ]);

        $encomienda->update($validatedData);

        return redirect()->route('encomiendas.index')->with('success', 'Encomienda actualizada con éxito');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $encomienda = Encomienda::find($id);

        if (!$encomienda) {
            return redirect()->route('encomiendas.index')->with('error', 'Encomienda no encontrada');
        }

        $encomienda->delete();

        return redirect()->route('encomiendas.index')->with('success', 'Encomienda eliminada con éxito');

    }
}
