<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table='rol';
    protected $fillable = [
        'idRol ',
        'nombre',
        'estatus'
    ];
    public $timestamps=false;
    public function permisos(){
        return $this->hasMany(Permisos::class);
    }
    public function usuario(){
        return $this->belongsToMany(Usuarios::class);
    }
}
