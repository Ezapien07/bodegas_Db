<?php

namespace Database\Seeders;

use App\Models\Usuarios;
use App\Models\Permisos;
use App\Models\Rol;
use App\Models\PermisosRoles;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Permisos::create([
            'nombre'=>'ViewInventario',
            'fechaAlta'=>Carbon::now()
        ]);
        Permisos::create([
            'nombre'=>'AddProductos',
            'fechaAlta'=>Carbon::now()
        ]);
        Permisos::create([
            'nombre'=>'AddInventario',
            'fechaAlta'=>Carbon::now()
        ]);
        Permisos::create([
            'nombre'=>'DeleteProductos',
            'fechaAlta'=>Carbon::now()
        ]);
        Permisos::create([
            'nombre'=>'SaidaProductos',
            'fechaAlta'=>Carbon::now()
        ]);
        Permisos::create([
            'nombre'=>'InventarioAlmacen',
            'fechaAlta'=>Carbon::now()
        ]);
        Permisos::create([
            'nombre'=>'Historial',
            'fechaAlta'=>Carbon::now()
        ]);
        Rol::create([
            'nombre'=>'Administrador',
            'estatus'=>1
        ]);
        Rol::create([
            'nombre'=>'Almacenista',
            'estatus'=>1
        ]);
        PermisosRoles::create([
            'idRol'=>1,
            'idPermiso'=>1,
            'fechaMov'=>Carbon::now()
        ]);
        PermisosRoles::create([
            'idRol'=>1,
            'idPermiso'=>2,
            'fechaMov'=>Carbon::now()
        ]);
        PermisosRoles::create([
            'idRol'=>1,
            'idPermiso'=>3,
            'fechaMov'=>Carbon::now()
        ]);
        PermisosRoles::create([
            'idRol'=>1,
            'idPermiso'=>4,
            'fechaMov'=>Carbon::now()
        ]);
        PermisosRoles::create([
            'idRol'=>1,
            'idPermiso'=>7,
            'fechaMov'=>Carbon::now()
        ]);
        PermisosRoles::create([
            'idRol'=>2,
            'idPermiso'=>1,
            'fechaMov'=>Carbon::now()
        ]);
        PermisosRoles::create([
            'idRol'=>2,
            'idPermiso'=>5,
            'fechaMov'=>Carbon::now()
        ]);
        PermisosRoles::create([
            'idRol'=>2,
            'idPermiso'=>6,
            'fechaMov'=>Carbon::now()
        ]);
        Usuarios::create([
            'nombre'=>'admin',
            'correo'=>'admin@bodega.com',
            'contrasena'=> Hash::make('root'),
            'idRol'=>1,
            'estatus'=>1
        ]);
        Usuarios::create([
            'nombre'=>'almacen',
            'correo'=>'almacenes@bodega.com',
            'contrasena'=> Hash::make('bo123'),
            'idRol'=>2,
            'estatus'=>1
        ]);
    }
}
