<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function autentificacion(Request $request){

        // Validacion de datos llegados del formulario
        $validacionDatos = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(!$validacionDatos){
            return back()->with('error', 'Datos incompletos');
            
        }

        // Logica para autentificar el usuario mediante email y contraseña
        if(Auth::attempt(["email" => $request->email, "password" => $request->password])){
            return redirect()->route('gestorDocumentos');
        }else{
            return back()->with("error", "las credenciales no coinciden");
        }
    }

    public function logout(){
        // logica logout
        Auth::logout();
        return redirect()->route('login');
    }
}
