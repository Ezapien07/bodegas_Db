<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisosRoles extends Model
{
    use HasFactory;

    public $timestamps=false;
    protected $table='permisos_roles';
    protected $fillable = [
        'idRol',
        'idPermiso',
        'fechaMov'
    ];
    public function permisos(){
        return $this->hasMany(Permisos::class);
    }
    public function roles(){
        return $this->hasMany(Rol::class);
    }
}
