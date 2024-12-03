<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encomienda;
use App\Models\Cliente;
use App\Models\Documento;
use App\Models\Viaje;
use App\Models\Paquete;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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

        Log::info('Datos recibidos:', $request->all());

        // Validar los datos recibidos
        $validated = $request->validate([
            //'tipo_cliente' => 'required|string|in:natural,juridica',
            'id_remitente' => 'required|integer',
            'id_destinatario' => 'required|integer',
            'viaje_id' => 'required|integer',
            'costo_total' => 'required|numeric|min:0',
        ]);

        // Determinar el valor de id_empresa
        $id_empresa = $request->tipo_cliente === 'natural' ? null : $request->id_empresa;

        // Crear el registro
        $encomienda = new Encomienda();
        $encomienda->id_viaje = $validated['viaje_id'];
        $encomienda->id_remitente = $validated['id_remitente'];
        $encomienda->id_destinatario = $validated['id_destinatario'];
        $encomienda->costo_total = $validated['costo_total'];
        $encomienda->fecha_registro = Carbon::now();
        $encomienda->estado_envio = 'Registrado';
        $encomienda->id_empresa = $id_empresa;// Null si tipo_cliente es natural
        $encomienda->save();

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
            'estado_envio' => 'nullable|string',
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
    public function boletaEncomienda($id)
    {
        // Recuperamos la encomienda con todas las relaciones necesarias
        $encomienda = Encomienda::with([
            'remitente.persona',
            'destinatario.persona',
            'viaje.vehiculo',
            'empresa.persona',
            'paquetes'
        ])->findOrFail($id);

        // Datos del remitente
        $remitente = $encomienda->remitente->persona;
        $nombre_remitente = $remitente->razon_social;
        $documento_remitente = $remitente->numero_documento;

        // Datos del destinatario
        $destinatario = $encomienda->destinatario->persona;
        $nombre_destinatario = $destinatario->razon_social; // Nombre de la persona particular
        $documento_destinatario = $destinatario->numero_documento;

        // Datos de la empresa (si aplica)
        //$empresa_destinataria = $encomienda->empresa ? $encomienda->empresa->persona->razon_social : null;
        $empresa_destinataria = $encomienda->empresa && $encomienda->empresa->persona
        ? $encomienda->empresa->persona->razon_social
        : null;

        // Datos del viaje
        $viaje = $encomienda->viaje;
        $vehiculo = $viaje->vehiculo;

        // Detalles de los paquetes
        $paquetes = $encomienda->paquetes;

        // Fecha y costo total de la encomienda
        $fecha_registro = $encomienda->fecha_registro;
        $costo_total = $encomienda->costo_total;

        // Generación de la boleta en PDF
        $pdf = \PDF::loadView('boletas.encomienda', compact(
            'encomienda',
            'nombre_remitente',
            'documento_remitente',
            'nombre_destinatario',
            'documento_destinatario',
            'empresa_destinataria', // Incluimos la empresa si existe
            'viaje',
            'vehiculo',
            'paquetes',
            'fecha_registro',
            'costo_total'
        ));

        // Retorna el PDF generado para su descarga
        return $pdf->download('boleta_encomienda_' . $encomienda->id . '.pdf');
    }
}
