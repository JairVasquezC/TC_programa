<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaPasaje extends Model
{
    protected $table = 'ventas_pasajes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_viaje', 'id_cliente', 'costo', 'fecha_venta', 'estado', 'id_empresa'
    ];

    // Relación con cliente (una venta de pasaje pertenece a un cliente)
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    // Relación con viaje (una venta de pasaje pertenece a un viaje)
    public function viaje()
    {
        return $this->belongsTo(Viaje::class, 'id_viaje');
    }

    // Relación con empresa (una venta de pasaje pertenece a una empresa)
    public function empresa()
    {
        return $this->belongsTo(Cliente::class, 'id_empresa');
    }

    // Relación con pagos (una venta de pasaje puede tener muchos pagos)
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_venta_pasaje');
    }
}
