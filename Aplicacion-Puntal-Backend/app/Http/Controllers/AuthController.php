<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Instalacion;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);  //no cogemos el token

         if (auth()->attempt($credentials)) {  //comprobación de autenticación

            //Comprobar si esta habilitado o no el usuario
            if(auth()->user()->habilitado == 1 && auth()->user()->perfil != "CUERPO-SEGURIDAD"){
                // dd("usuario habilitado");
                return redirect()->route('home');  //nos redirije a la ruta 'admin'

            }
            else{
                session()->flash('message', 'Disabled User');
                return redirect()->back();
            }


        } else {
            // dd($request);
            session()->flash('message', 'Invalid credentials');
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('login');
    }

    public function infoUser(){
        $usuario = Usuario::find(auth()->user()->email);
        $instalaciones = Usuario::find(auth()->user()->email)->instalacionesUsuario() -> get() -> pluck("nombrePuerto");

        return view('usuario.show', compact('usuario','instalaciones'));
    }

    public function editUser(){
        $usuario = Usuario::find(auth()->user()->email);
        $instalacionesChecked = Usuario::find(auth()->user()->email)->instalacionesUsuario() -> get() -> pluck('id');
        $instalaciones = Instalacion::all();

        return view('usuario.edit', compact('usuario','instalaciones','instalacionesChecked'));

    }
}

