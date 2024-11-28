<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Cliente;
use App\Models\Documento;
use App\Models\Persona;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class clienteController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-cliente|crear-cliente|editar-cliente|eliminar-cliente', ['only' => ['index']]);
        $this->middleware('permission:crear-cliente', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-cliente', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-cliente', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::with('persona.documento')->get();
        return view('cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documentos = Documento::all();
        return view('cliente.create', compact('documentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonaRequest $request)
    {
        try {
            DB::beginTransaction();
            $persona = Persona::create($request->validated());
            $persona->cliente()->create([
                'persona_id' => $persona->id
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('clientes.index')->with('success', 'Cliente registrado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        $cliente->load('persona.documento');
        $documentos = Documento::all();
        return view('cliente.edit', compact('cliente', 'documentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        try {
            DB::beginTransaction();

            Persona::where('id', $cliente->persona->id)
                ->update($request->validated());

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('clientes.index')->with('success', 'Cliente editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $persona = Persona::find($id);
        if ($persona->estado == 1) {
            Persona::where('id', $persona->id)
                ->update([
                    'estado' => 0
                ]);
            $message = 'Cliente eliminado';
        } else {
            Persona::where('id', $persona->id)
                ->update([
                    'estado' => 1
                ]);
            $message = 'Cliente restaurado';
        }

        return redirect()->route('clientes.index')->with('success', $message);
    }

    public function storeAjax(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validar los datos del formulario
            $validated = $request->validate([
                'tipo_persona' => 'required|string',
                'razon_social' => 'required|string|max:255',
                'direccion' => 'required|string|max:255',
                'documento_id' => 'required|exists:documentos,id',
                'numero_documento' => 'required|string|max:255',
                // Otros campos de validación...
            ]);

            // Crear la persona y el cliente asociado
            $persona = Persona::create($validated);
            $persona->cliente()->create([
                'persona_id' => $persona->id
            ]);

            DB::commit();

            // Respuesta JSON con mensaje
            return response()->json([
                'success' => true,
                'message' => 'Persona creada exitosamente', // Asegúrate de que el mensaje sea correcto
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            // Respuesta en caso de error
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al crear la persona. Inténtalo de nuevo.',
            ]);
        }
    }

    

}
