<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;



class AuthController extends Controller
{
    public $successStatus = 200;

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();

            // dd($user -> habilitado);

            if($user -> habilitado == 1){
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                $details = Usuario::with('instalacionesUsuario')->find($user->email);
                return response()->json([
                    'success' => $success,
                    'details' => $details
                ], $this->successStatus);
            }
            else{
                return response()->json(['error' => 'Disabled User'], 401);
            }

        } else {
            return response()->json(['error' => 'Invalid Credential'], 401);
        }
    }

    public function details()
    {
        // Toda la informacion del usuario con los puertos asociados
        $user = Usuario::where("email",Auth::user()->email)->with('instalacionesUsuario')->get();

        return response()->json(['success' => $user], $this->successStatus);
    }

    public function role()
    {
        $user = Auth::user();
        //dd($user->perfil);

        // Toda la informacion del usuario con los puertos asociados
        /* $user = Usuario::where("email",Auth::user()->email)->value('perfil'); */

        return response()->json($user->perfil, $this->successStatus);
    }

    public function logout(Request $request)
    {
        $isUser = $request->user()->token()->revoke();
        if($isUser){
            $success['message'] = "Successfully logged out.";
            return response()->json(['success' => $isUser], $this->successStatus);
        }
        else{
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
