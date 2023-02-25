<?php

namespace App\Http\Controllers;

use App\Models\Instalacion;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;



/**
 * Class UsuarioController
 * @package App\Http\Controllers
 */
class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('gerencia')->only(['index','show']);
        $this->middleware('xunta')->except(['index','show']);
    }

    public function index()
    {
        // dd('Funcion INDEX');

        // Traemos todos los datos del usuario logueado y sus relaciones con los puertos.
        $usuarioLogeado = Usuario::where("email",auth()->user()->email)->with('instalacionesUsuario')->get();

        // En caso de que no tenga acceso a todos los puertos, filtraremos la busqueda de usuarios.
        if($usuarioLogeado[0]->instalacionesUsuario[0]->id != 0){ //Si la primera instalacion del usuario es id != 0 (todos los puertos)...
            // Traemos a todos los usuarios (con las relaciones a Instalaciones) menos el usuario logueado.
            $usuarios = Usuario::with('instalacionesUsuario')->where('email','!=',auth()->user()->email);

            // dd("Filtramos usuarios por puerto");
            // Filtramos los usuarios, para traer los que tengan los mismos puertos relacionados que el usuario logeado.
            $usuarios= $usuarios->whereHas('instalacionesUsuario',function ($query) use ($usuarioLogeado) {

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

        $roleAcceso = auth()->user()->perfil;

        return view('usuario.index', compact('usuarios', 'roleAcceso') )->with('i',0);
    }

    public function create()
    {
        // dd('Funcion CREATE');

        $usuario = new Usuario();
        $instalaciones = Instalacion::all();
        $instalacionesChecked = [0];
        $usuario->perfil =0;
        $usuario->idioma =0;

        return view('usuario.create', compact('usuario', 'instalaciones', 'instalacionesChecked'));
    }

    public function store(Request $request)
    {
        // dd('Funcion STORE');

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
        // dd('Funcion SHOQ');

        $usuario = Usuario::find($id);
        $instalaciones = Usuario::find($id)->instalacionesUsuario() -> get() -> pluck("nombrePuerto");
        $roleAcceso = auth()->user()->perfil;

        return view('usuario.show', compact('usuario','instalaciones','roleAcceso'));
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
        // dd($usuario);


        $nuevoUsuario = $request->validate([
            // 'nombreUsuario' => 'required|max:50',
            'nombreUsuario' => [
                'required',
                'max:50',
                Rule::unique('usuarios')->ignore($usuario->nombreUsuario,'nombreUsuario')
            ],

            "password" => 'required|min:6|max:100',
            'nombreCompleto' => 'required|max:100',
            // 'email' => 'required|email|max:100',
            'email' => [
                'required',
                'max:100',
                'email',
                Rule::unique('usuarios')->ignore($usuario->email,'email')
            ],
            'habilitado' => 'required',
            'perfil' => 'required',
            'idioma' => 'required',
            'visto' => 'required',
        ]);
        //Rule:.unique... sirve para mantener el funcionamiento de unique pero si le mandamos el mismo valor que ya teniamos almacenado, no devolvera error
        
        // dd($request);


        // SI CAMBIAMOS LA CONTRASEÑA
        if($nuevoUsuario['password'] != $usuario->password){
            $nuevoUsuario['password'] = bcrypt($request->password); // Encriptamos la nueva contraseña contraseña
        }
        // dd($nuevoUsuario);
        // dd(Usuario::find($usuario->email));

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
