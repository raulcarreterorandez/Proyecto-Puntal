<?php

namespace App\Http\Controllers;

use App\Models\Instalacion;
use App\Models\Usuario;
use Illuminate\Http\Request;

/**
 * Class UsuarioController
 * @package App\Http\Controllers
 */
class UsuarioController extends Controller
{

    public function index()
    {
        $usuarios = Usuario::all()->except(auth()->user()->email); // Login Laravel
        // $usuarios = Usuario::all(); // Sin Login Laravel


        $instalaciones = Instalacion::all();

        return view('usuario.index', compact('usuarios', 'instalaciones') )->with('i',0);
    }

    public function create()
    {
        $usuario = new Usuario();
        $instalaciones = Instalacion::all();
        $instalacionesChecked = [0];
        $usuario->perfil =0;
        $usuario->idioma =0;
        // dd($usuario->perfil);

        return view('usuario.create', compact('usuario', 'instalaciones', 'instalacionesChecked'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // CREAMOS AL USUARIO
        $usuario = $request->validate([
            'nombreUsuario' => 'required|max:50|unique:usuarios,nombreUsuario',
            "password" => 'required|min:6|max:50',
            'nombreCompleto' => 'required|max:100',
            'email' => 'required|email|max:100|unique:usuarios,email',
            'habilitado' => 'required',
            'perfil' => 'required|distinct:no',
            'idioma' => 'required',
            'visto' => 'required',
        ]);
        $usuario['password'] = bcrypt($request->password); // Encriptamos la contraseña

        // dd($usuario);

        Usuario::create($usuario);

        // CREAMOS LA RELACION EN LA TABLA INTERMEDIA
        $this->insertarTablaIntermedia($request->instalaciones, $request->email);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario created successfully.');
    }

    public function show($id)
    {

        $usuario = Usuario::find($id);
        $instalaciones = Usuario::find($id)->instalacionesUsuario() -> get() -> pluck("nombrePuerto");

        return view('usuario.show', compact('usuario','instalaciones'));
    }

    public function edit($id)
    {
        $usuario = Usuario::find($id);
        $instalacionesChecked = Usuario::find($id)->instalacionesUsuario() -> get() -> pluck('id');
        $instalaciones = Instalacion::all();

        return view('usuario.edit', compact('usuario','instalaciones','instalacionesChecked'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        // dd($request);

        $nuevoUsuario = $request->validate([
            'nombreUsuario' => 'required|max:50',
            "password" => 'required|min:6|max:100',
            'nombreCompleto' => 'required|max:100',
            'email' => 'required|email|max:100',
            'habilitado' => 'required',
            'perfil' => 'required',
            'idioma' => 'required',
            'visto' => 'required',
        ]);
        // dd($request);


        // SI CAMBIAMOS LA CONTRASEÑA
        if($nuevoUsuario['password'] != $usuario->password){
            $nuevoUsuario['password'] = bcrypt($request->password); // Encriptamos la nueva contraseña contraseña
        }

        Usuario::find($usuario->email) -> update($nuevoUsuario);
        Usuario::find($request->email)->instalacionesUsuario() -> sync($request->instalaciones);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario updated successfully');
    }



    /**
     * NO ELIMINAMOS USUARIOS, LOS DESHABILITAMOS
     */
    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        $usuarioDeshabilitado = clone $usuario;
        $usuarioDeshabilitado -> habilitado = 0;

        $usuario->update($usuarioDeshabilitado->toArray());

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario disable successfully');
    }


    public function insertarTablaIntermedia($idInstalacion, $idUsuario){

        $instalacion = Instalacion::find($idInstalacion);
        $usuario = Usuario::findOrFail($idUsuario);

        $usuario -> instalacionesUsuario() -> attach($instalacion);

    }

    public function confirm($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuario.confirm', compact('usuario'));
    }
}
