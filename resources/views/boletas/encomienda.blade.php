<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleta de Encomienda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .boleta {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
        }
        .seccion {
            margin: 10px 0;
        }
        .seccion p {
            margin: 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="boleta">
        <div class="header">
            <h2>Boleta de Encomienda</h2>
            <p>Fecha de emisión: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
        </div>

        <div class="seccion">
            <h4>Datos del Remitente:</h4>
            <p><strong>Nombre:</strong> {{ $nombre_remitente }}</p>
            <p><strong>Documento:</strong> {{ $documento_remitente }}</p>
        </div>

        <div class="seccion">
            <h4>Datos del Destinatario:</h4>
            <p><strong>Nombre:</strong> {{ $nombre_destinatario }}</p>
            <p><strong>Documento:</strong> {{ $documento_destinatario }}</p>
            @if($empresa_destinataria)
                <p><strong>Empresa:</strong> {{ $empresa_destinataria }}</p>
            @endif
        </div>

        <div class="seccion">
            <h4>Datos del Viaje:</h4>
            <p><strong>Fecha y Hora:</strong> {{ $viaje->fecha }} - {{ $viaje->hora }}</p>
            <p><strong>Vehículo:</strong> {{ $vehiculo->tipo }} - {{ $vehiculo->placa }}</p>
        </div>

        <div class="seccion">
            <h4>Detalles de los Paquetes:</h4>
            @foreach ($paquetes as $paquete)
                <p><strong>Descripción:</strong> {{ $paquete->descripcion }}</p>
                <p><strong>Dimensiones:</strong> {{ $paquete->dimension_ancho }} x {{ $paquete->dimension_largo }} x {{ $paquete->dimension_grosor }} cm</p>
                <p><strong>Peso:</strong> {{ $paquete->peso }} kg</p>
                <p><strong>Costo:</strong> S/ {{ number_format($paquete->costo, 2) }}</p>
                <hr>
            @endforeach
        </div>

        <div class="seccion">
            <h4>Resumen del Costo:</h4>
            <p><strong>Total:</strong> S/ {{ number_format($costo_total, 2) }}</p>
        </div>

        <div class="footer">
            <p>Gracias por confiar en nuestro servicio.</p>
        </div>
    </div>
</body>
</html>
