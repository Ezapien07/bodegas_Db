<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;
    protected $table='historial';
    protected $primaryKey = 'idHistorial';
    protected $fillable = [
        'idHistorial',
        'cantidad',
        'movimiento',
        'fechaMov',
        'idProducto',
        'idUserMov'
    ];
    public $timestamps=false;
    public function productos(){
        return $this->hasMany(Productos::class);
    }
    public function usuarios(){
        return $this->hasMany(Usuarios::class);
    }
}
