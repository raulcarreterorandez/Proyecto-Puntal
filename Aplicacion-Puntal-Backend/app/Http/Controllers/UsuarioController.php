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
        // En caso de que no tenga acceso a todos los puertos, filtraremos la busqueda de usuarios
        $usuarioLogeado = Usuario::where("email",auth()->user()->email)->with('instalacionesUsuario')->get();

        if($usuarioLogeado[0]->instalacionesUsuario[0]->id != 0){
            // Traemos a todos los usuarios (con las relaciones a Instalaciones) menos el usuario logueado
            $usuarios = Usuario::with('instalacionesUsuario')->where('email','!=',auth()->user()->email);

            // dd("Filtramos usuarios por puerto");
            // Filtramos los usuarios, para traer los que tengan los mismos puertos relacionados que el usuario logeado
            $usuarios= $usuarios->whereHas('instalacionesUsuario',function ($query) {

                // Traemos todos los datos del usuario logueado y sus relaciones con los puertos
                $usuarioLogeado = Usuario::where("email",auth()->user()->email)->with('instalacionesUsuario')->get();

                // Filtramos para que el idInstalacion sea el mismo que el puerto relacionado con el usuario logueado (tantas veces como puertos tenga)
                $query->where(function($query) use ($usuarioLogeado){
                    foreach ($usuarioLogeado[0]->instalacionesUsuario as $instalacion) {
                        $query->orWhere('idInstalacion',$instalacion->id);
                    }
                });

            })->get();
        }
        else{
        // Traemos a todos los usuarios (con las relaciones a Instalaciones) menos el usuario logueado
        $usuarios = Usuario::with('instalacionesUsuario')->where('email','!=',auth()->user()->email)->get();
    }

        return view('usuario.index', compact('usuarios') )->with('i',0);
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
