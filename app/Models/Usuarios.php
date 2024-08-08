<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Usuarios extends Authenticatable
{
    use HasFactory,Notifiable;
    protected $table='usuarios';
    protected $primaryKey = 'idUsuario';
    protected $fillable = [
        'idUsuario ',
        'nombre',
        'correo',
        'contrasena',
        'idRol ','estatus'
    ];
    /**
     * The attribute that should be used for authentication.
     *
     * @var string
     */
    protected $username = 'nombre';
    public $timestamps=false;
    public function encrypt ($contrasena)
    {
        return Hash::make($contrasena);
    }
    public function rol(){
        return $this->belongsTo(Rol::class);
    }
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

}
