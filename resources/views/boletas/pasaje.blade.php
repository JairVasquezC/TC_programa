<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleta de Venta</title>
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
        .cliente, .viaje, .costos {
            margin: 10px 0;
        }
        .cliente p, .viaje p, .costos p {
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
            <h2>Boleta de Venta de Pasaje</h2>
            <p>Fecha de emisión: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
        </div>

        <div class="cliente">
            <h4>Datos del Cliente:</h4>
            <p><strong>Nombre:</strong> {{ $tipo_cliente }}</p>
            <p><strong>Documento:</strong> {{ $documento_cliente }}</p>
        </div>

        <div class="viaje">
            <h4>Datos del Viaje:</h4>
            <p><strong>Fecha y Hora:</strong> {{ $viaje->fecha }} - {{ $viaje->hora }}</p>
            <p><strong>Vehículo:</strong> {{ $vehiculo->tipo }} - {{ $vehiculo->placa }}</p>
        </div>

        <div class="costos">
            <h4>Detalles del Costo:</h4>
            <p><strong>Costo:</strong> S/ {{ number_format($costo, 2) }}</p>
        </div>

        <div class="footer">
            <p>Gracias por su compra.</p>
        </div>
    </div>

</body>
</html>
