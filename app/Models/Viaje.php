<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    protected $table = 'viajes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'fecha', 'hora', 'id_chofer', 'id_vehiculo', 'estado'
    ];

    // Relación con chofer (un viaje tiene un chofer, que es un usuario)
    public function chofer()
    {
        return $this->belongsTo(User::class, 'id_chofer');
    }

    // Relación con vehículo (un viaje tiene un vehículo asignado)
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo');
    }

    // Relación con ventas de pasajes (un viaje puede tener muchas ventas de pasajes)
    public function ventasPasajes()
    {
        return $this->hasMany(VentaPasaje::class, 'id_viaje');
    }

    // Relación con encomiendas (un viaje tiene muchas encomiendas)
    public function encomiendas()
    {
        return $this->hasMany(Encomienda::class, 'id_viaje');
    }
}
