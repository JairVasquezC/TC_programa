<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encomienda extends Model
{
    protected $table = 'encomiendas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'costo_total', 'estado_envio', 'fecha_registro', 'id_remitente', 'id_destinatario', 'id_viaje', 'id_empresa'
    ];

    // Relación con remitente (una encomienda tiene un remitente que es un cliente)
    public function remitente()
    {
        return $this->belongsTo(Cliente::class, 'id_remitente');
    }

    // Relación con destinatario (una encomienda tiene un destinatario que es un cliente)
    public function destinatario()
    {
        return $this->belongsTo(Cliente::class, 'id_destinatario');
    }

    // Relación con viaje (una encomienda pertenece a un viaje)
    public function viaje()
    {
        return $this->belongsTo(Viaje::class, 'id_viaje');
    }

    // Relación con empresa (una encomienda tiene una empresa que es un cliente)
    public function empresa()
    {
        return $this->belongsTo(Cliente::class, 'id_empresa');
    }

    // Relación con paquetes (una encomienda tiene muchos paquetes)
    public function paquetes()
    {
        return $this->hasMany(Paquete::class, 'id_encomienda');
    }

    // Relación con pagos (una encomienda puede tener muchos pagos)
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_encomienda');
    }
}
