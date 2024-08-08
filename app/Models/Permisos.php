<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Permisos extends Model
{
    use HasFactory;

    protected $table='permisos';
    protected $fillable = [
        'idPermiso',
        'nombre',
        'fechaAlta',
    ];
    public $timestamps=false;


    public function rol(){
        return $this->belongsTo(Rol::class);
    }

}
