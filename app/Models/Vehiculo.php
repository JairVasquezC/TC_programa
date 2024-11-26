<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'placa', 'tipo', 'capacidad_peso', 'capacidad_personas'
    ];

    // Relación con viajes (un vehículo tiene muchos viajes)
    public function viajes()
    {
        return $this->hasMany(Viaje::class, 'id_vehiculo');
    }
}