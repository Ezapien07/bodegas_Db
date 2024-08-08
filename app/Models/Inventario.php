<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    protected $table='inventarios';
    protected $primaryKey = 'idInventario';
    protected $fillable = [
        'idInventario',
        'cantidad',
        'fechaMov',
        'idUserMov'
    ];
    public $timestamps=false;
    public function usuario(){
        return $this->belongsTo(Usuarios::class);
    }
}
