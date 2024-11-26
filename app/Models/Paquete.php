<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    protected $table = 'paquetes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'descripcion', 'dimension_ancho', 'dimension_largo', 'dimension_grosor', 'peso', 'costo', 'id_encomienda'
    ];

    // Relación con encomienda (un paquete pertenece a una encomienda)
    public function encomienda()
    {
        return $this->belongsTo(Encomienda::class, 'id_encomienda');
    }
}
