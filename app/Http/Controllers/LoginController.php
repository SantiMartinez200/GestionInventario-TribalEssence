<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function vista(){
        return view('login/login');
    }


    public function autenticacion(Request $request){

     
        $usuarios = User::all();
        foreach ($usuarios as $usuario) {
            if ($usuario->username == $request->input('usuario') && ($usuario->password == $request->input('contraseña') )){
               return redirect('aromas');
            }else{
                return redirect('login');
            }
        }
    }

    public function cerrarSession(){
        
    }
}
