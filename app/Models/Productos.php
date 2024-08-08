<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $table='productos';
    protected $primaryKey = 'idProducto';
    protected $fillable = [
        'idProducto',
        'nombre',
        'estatus',
        'precio',
        'idInventario',
        'fechaMov',
        'idUserMov'
    ];
    public $timestamps=false;
    public function inventario(){
        return $this->belongsTo(Inventario::class);
    }
    public function usuario(){
        return $this->belongsTo(Usuarios::class);
    }
}
