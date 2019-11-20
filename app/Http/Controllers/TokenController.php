<?php
namespace App\Http\Controllers;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function gerarToken(Request $request)
    {
        /*$this->validate($request, [
            'usuario' => 'required|usuario',
            'senha' => 'required'
        ]);*/
        $usuario = User::where('usuario', $request->usuario)->first();

        if(is_null($usuario)
            || password_verify($request->senha, $usuario->senha)//!Hash::check($request->senha, $usuario->senha)
        ) {
            return response()->json('Usuário ou senha inválidos', 401);
        }

        $token = JWT::encode(
            ['usuario' => $request->usuario],
            env('JWT_KEY')
        );

        return ['access_token' => $token];
    }
}