<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use App\Models\Inventario;
use App\Models\Productos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductosController extends Controller
{

    public function ConsultarAll()
    {
        $productos=Productos::join('inventarios','productos.idInventario','=','inventarios.idInventario')->get();
        return view('productos.productos',compact('productos'));
    }
    public function getProductosSaida(){
        $productos=Productos::join('inventarios','productos.idInventario','=','inventarios.idInventario')->where('estatus','=',1)->get();
        return view('salidas.salidas',compact('productos'));
    }
    public function getProductosInventario(){
        $productos=Productos::join('inventarios','productos.idInventario','=','inventarios.idInventario')->get();
        return view('inventario.inventario',compact('productos'));
    }
    public function newProducto(Request $request)
    {
        try {

            DB::beginTransaction();
            // $idUserMov = (int)session()->get('user_id');
            $mInventario= new Inventario();
            $mInventario->cantidad=0;
            $mInventario->fechaMov=Carbon::now();
            $mInventario->idUserMov=Auth::user()->idUsuario;
            $mInventario->save();
            if (!$mInventario->idInventario) {
                throw new Exception("No se pudo guardar el inventario.");
            }
            $mProducto = new Productos();
            $mProducto->nombre=$request->nombre;
            $mProducto->estatus=1;
            $mProducto->precio=(double)$request->precio;
            $mProducto->idInventario=$mInventario->idInventario;
            $mProducto->idUserMov =Auth::user()->idUsuario;
            $mProducto->fechaMov=Carbon::now();
            $mProducto->save();
            DB::commit(); // Confirmar la transacci
            return "true";
        } catch (Exception $err) {
            DB::rollBack(); // Revertir la transacción en caso de error
            return $err;
        }
    }
    public function updateProducto(Request $request){
        try{
            $mProducto=Productos::find($request->id);
            $mProducto->nombre=$request->nombre;
            $mProducto->estatus=$request->estatus;
            $mProducto->precio=$request->precio;
            $mProducto->idInventario=$request->idInventario;
            $mProducto->fechaMov=Carbon::now();
            $mProducto->idUserMov=Auth::user()->idUsuarioidUsuario;
            $mProducto->save();
            return true;
        }catch(Exception $ex){
            return $ex;
        }
    }
    public function Aumentar(Request $request){
        try{
            $mProducto= Productos::where('idProducto','=',$request->idProducto)->first();
            $mInventario=Inventario::where('idInventario','=',$mProducto->idInventario)->first();
            $newCantidad=($mInventario->cantidad+$request->cantidad);
            $mInventario->cantidad=$newCantidad;
            $mInventario->idUserMov=Auth::user()->idUsuario;
            $mInventario->fechaMov=Carbon::now();
            $mInventario->save();

            $mHistorial= new Historial();
            $mHistorial->cantidad=$request->cantidad;
            $mHistorial->movimiento=1;
            $mHistorial->fechaMov=Carbon::now();
            $mHistorial->idProducto=$mProducto->idProducto;
            $mHistorial->idUserMov=Auth::user()->idUsuario;
            $mHistorial->save();
            return "true";

        }catch(Exception $ex){
            return $ex;
        }
    }
    public function Salida(Request $request)  {
        try{
            $mProducto= Productos::where('idProducto','=',$request->idProducto)->first();
            $mInventario=Inventario::where('idInventario','=',$mProducto->idInventario)->first();
            $newCantidad=($mInventario->cantidad-$request->cantidad);
            $mInventario->cantidad=$newCantidad;
            $mInventario->idUserMov=Auth::user()->idUsuario;
            $mInventario->fechaMov=Carbon::now();
            $mInventario->save();

            $mHistorial= new Historial();
            $mHistorial->cantidad=$request->cantidad;
            $mHistorial->movimiento=2;
            $mHistorial->fechaMov=Carbon::now();
            $mHistorial->idProducto=$mProducto->idProducto;
            $mHistorial->idUserMov=Auth::user()->idUsuario;
            $mHistorial->save();
            return "true";

        }catch(Exception $ex){
            return $ex;
        }
    }
    public function Activar(Request $request){
        try{
            $mProducto=Productos::where('idProducto','=',$request->idProducto)->first();
            $mProducto->estatus=1;
            $mProducto->idUserMov=Auth::user()->idUsuario;
            $mProducto->fechaMov=Carbon::now();
            $mProducto->save();
            return "true";
        }catch(Exception $ex){
            return $ex;
        }
    }
    public function Eliminar(Request $request){
        try{
            $mProducto=Productos::where('idProducto','=',$request->idProducto)->first();
            $mProducto->estatus=2;
            $mProducto->idUserMov=Auth::user()->idUsuario;
            $mProducto->fechaMov=Carbon::now();
            $mProducto->save();
            return "true";
        }catch(Exception $ex){
            return $ex;
        }
    }

}
