<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\Usuario;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class MensajeController
 * @package App\Http\Controllers
 */
class MensajeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $mensajes = Mensaje::where('idUsuarioDestino',$user->email)->get(); // Login Laravel
        // $mensajes = Mensaje::all(); // Sin Login Laravel


        return view('mensaje.index', compact('mensajes') )->with('i',0);

    }

    public function create()
    {
        $mensaje = new Mensaje();
        $user = Auth::user()->email;
        $usuarios = Usuario::all()->except(auth()->user()->email)->pluck('email','email');
        // dd($user);
        return view('mensaje.create', compact('mensaje','user','usuarios'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'texto' => 'required|max:530',
            'idUsuarioOrigen' => 'required|email|max:100',
            'idUsuarioDestino' => 'required|email|max:100',
        ]);

        $now = new DateTime('now', new DateTimeZone("Europe/Madrid"));
        $mensaje = new Mensaje();

        $mensaje->texto = $request->texto;
        $mensaje->leido = $request->leido;
        $mensaje->idUsuarioOrigen = $request->idUsuarioOrigen;
        $mensaje->idUsuarioDestino = $request->idUsuarioDestino;
        $mensaje->fecha_hora = $now -> format('Y-m-d H:i:s');

        // dd($mensaje);

        Mensaje::create($mensaje->toArray());

        return redirect()->route('mensajes.index')
            ->with('success', 'Mensaje created successfully.');
    }

    public function show($id)
    {
        $mensaje = Mensaje::find($id);

        // Dejamos el mensaje como visto y lo actualizamos en la base de datos
        $ensajeVisto = clone $mensaje;
        $ensajeVisto ->leido = 1;
        $mensaje -> update($ensajeVisto->toArray());

        return view('mensaje.show', compact('mensaje'));
    }

    public function update(Request $request, Mensaje $mensaje)
    {
        request()->validate(Mensaje::$rules);

        $mensaje->update($request->all());

        return redirect()->route('mensajes.index')
            ->with('success', 'Mensaje updated successfully');
    }

    public function destroy($id)
    {
        Mensaje::find($id)->delete();

        return redirect()->route('mensajes.index')
            ->with('success', 'Mensaje deleted successfully');
    }

    public function responder($id){
        // dd($id);
        $mensaje = new Mensaje();
        $user = Auth::user()->email;
        $usuario = Usuario::find($id)->email;

        return view('mensaje.responder', compact('mensaje','user','usuario'));
    }
}
