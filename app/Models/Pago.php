<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_encomienda', 'id_venta_pasaje', 'monto', 'metodo_pago', 'estado', 'fecha_pago'
    ];

    // Relación con encomienda (un pago puede estar asociado a una encomienda)
    public function encomienda()
    {
        return $this->belongsTo(Encomienda::class, 'id_encomienda');
    }

    // Relación con venta_pasaje (un pago puede estar asociado a una venta de pasaje)
    public function ventaPasaje()
    {
        return $this->belongsTo(VentaPasaje::class, 'id_venta_pasaje');
    }
}
