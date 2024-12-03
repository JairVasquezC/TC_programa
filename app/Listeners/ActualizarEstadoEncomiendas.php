<?php

namespace App\Listeners;

use App\Events\EstadoViajeActualizado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActualizarEstadoEncomiendas
{
    public function handle(EstadoViajeActualizado $event)
    {
        $viaje = $event->viaje;
        $nuevoEstado = $this->mapearEstadoEncomienda($viaje->estado);

        // Actualizar el estado de las encomiendas relacionadas
        $viaje->encomiendas()->update(['estado_envio' => $nuevoEstado]);
    }

    private function mapearEstadoEncomienda($estadoViaje)
    {
        return match ($estadoViaje) {
            'En Camino' => 'En Camino',
            'Finalizado' => 'Para Recojo',
            default => 'Registrado',
        };
    }
}
