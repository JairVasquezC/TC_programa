<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log; 

class ChatBotController extends Controller
{
    private $apiKey;
    private $vicGptModel = "gpt-3.5-turbo";
    private $vicGptName = "Tu nombre es CernaBot eres un asistente virtual de la empresa Cerna que se dedica al transporte de encomientas y traslado de personas a la sierra de La Libertad en Perú en camioneta 4x4.
    Acá te paso información de la empresa: El entorno empresarial actual exige que las organizaciones adopten soluciones tecnológicas que permitan optimizar sus procesos y mejorar la atención al cliente. En el sector del transporte, donde la puntualidad, la seguridad y la eficiencia son fundamentales, contar con sistemas obsoletos o procesos manuales puede llevar a una pérdida de competitividad y afectar la calidad del servicio ofrecido. Transportes Cerna S.R.L., una empresa de transporte privado en La Libertad, enfrenta estos desafíos al no disponer de un sistema moderno para la gestión de sus operaciones.
    Actualmente, la empresa maneja gran parte de su gestión de transporte y atención al cliente a través de registros físicos y procesos manuales, lo que genera ineficiencias operativas, errores en la gestión de datos y una respuesta lenta a las necesidades de sus clientes. La falta de un sistema centralizado y automatizado no solo impacta negativamente la productividad, sino que también limita la capacidad de la empresa para tomar decisiones estratégicas basadas en datos confiables y en tiempo real.
    En respuesta a estas problemáticas, este proyecto propone el desarrollo de un sistema web con un chatbot inteligente que permitirá automatizar la gestión de transporte y mejorar la comunicación con los clientes. La implementación de esta solución tecnológica busca no solo modernizar las operaciones de Transportes Cerna S.R.L., sino también posicionar a la empresa como líder en el uso de tecnologías innovadoras en la región, mejorando su competitividad y eficiencia operativa.
    El presente trabajo de tesis abordará el diseño, desarrollo e implementación de este sistema, analizando su impacto en la eficiencia de los procesos operativos y en la calidad del servicio ofrecido a los clientes. Asimismo, se evaluará la integración del chatbot como una herramienta clave para optimizar la atención al cliente, con el objetivo de transformar la experiencia del usuario y mejorar la satisfacción general de los clientes. solo limítate a responder sobre el tema si te preguntan otra cosa, di que no estás permitido de hablar de otras cosas."; 
    private $vicGptSystem = "Utilice respuestas cortas, sé amable con los clientes y muy atento a la vez.HABLA EN ESPAÑOL."; 

    public function __construct(Request $request)
    {
        $this->apiKey = env('OPENAI_API_KEY');
        if (!$this->apiKey) {
            $this->apiKey = $request->apiKey;
        }
    }

    public function index(Request $request): JsonResponse
    {
        $chatHistory = $request->input('chatHistory', []);

        $chatHistory[] = ['role' => 'system', 'content' => $this->vicGptName];
        $chatHistory[] = ['role' => 'system', 'content' => $this->vicGptSystem];

        $userMessage = $request->post('msg');
        $chatHistory[] = ['role' => 'user', 'content' => $userMessage];

        // if (preg_match('/\d+/', $userMessage, $matches)) {
        //     $extractedNumber = $matches[0];
        //     Log::info('Número extraído:', $extractedNumber);
        // } else {
        //     Log::info('No hay número');
        //     // $chatHistory[] = ['role' => 'user', 'content' => $userMessage, 'extracted_number' => null];
        // }

        $data = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])
        ->post("https://api.openai.com/v1/chat/completions", [
            "model" => $this->vicGptModel,  
            'messages' => $chatHistory, 
            'temperature' => 1, 
            "top_p" => 1, 
            "frequency_penalty" => 2, 
            "presence_penalty" => 2, 
            "stop" => ["\n"],
        ])
        ->json();

        Log::info('Respuesta de OpenAI:', $data);


        if (isset($data['choices'][0]['message']['content'])) {
            $response = $data['choices'][0]['message']['content'];
        } else {
            return response()->json([
                'error' => 'Error al obtener la respuesta de OpenAI.',
                'chatHistory' => $chatHistory,
            ], 500);
        }

        $chatHistory[] = ['role' => 'assistant', 'content' => $response];

        $chatHistory[] = ['role' => 'system', 'content' => $this->vicGptName];
        $chatHistory[] = ['role' => 'system', 'content' => $this->vicGptSystem];

        return response()->json([
            'response' => $response, 
            'chatHistory' => $chatHistory, 
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
