<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function username()
    {
        return 'username';
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function home()
    {
        return view('login.pagina_principal');
    }

    public function login()
    {
        return view('login.login');
    }

    public function loginPost(Request $request)
    {
      // Ejecutar validaciones de la petición
      $credenciales=[
        "correo"=>$request->correo,
        "contrasena"=>$request->contrasena
      ];
      $validateData = $request->validate([
        'contrasena' => 'required',
        'correo' => 'required'
         ]);

         if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            //$usuario = Auth::user(); // Obtener el usuario autenticado

            return response()->json(['message' => 'Entra al sistema porque las credenciales son correctas'], 200);
        } else {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }
    }

    public function authenticate(Request $request)
    {
        try{
            $credentials = $request->validate([
                'nombre' => ['required'],
                'contrasena' => ['required'],
            ]);

            if (Auth::guard('web')->attempt(['nombre' => $credentials['nombre'], 'password' => $credentials['contrasena']])){
                $request->session()->regenerate();
                return 4;
                // return response()->json(['message' => 'Entra al sistema porque las credenciales son correctas'], 200);
            }
            return 1;
            //return response()->json(['message' => 'Error'], 401);
        } catch (Exception $er) {
            return response()->json(['message' => $er->getMessage()], 500);
        }

    }
}
