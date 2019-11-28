<?php
namespace App\Http\Controllers;

use App\User;
use App\Empresa;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

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
            || password_verify($request->senha, $usuario->senha)
        ) {
            return response()->json('Usuário ou senha inválidos', 401);
        }

        $token = JWT::encode(
            ['usuario' => $request->usuario],
            env('JWT_KEY')
        );

        return ['access_token' => $token];
    }

    public function gerarTokenEmpresa(Request $request)
    {
        $empresa = Empresa::where('id', $request->empresa)->first();

        config(['database.connections.tenant.database' => $empresa->base]);
        //config(['database.connections.tenant.username' => $empresa->base]);

        $usuario = User::where('usuario', $request->usuario)->first();

        if(is_null($usuario)
            || !password_verify($request->senha, $usuario->senha)
        ) {
            return response()->json('Usuário ou senha inválidos', 401);
        }

        $token = JWT::encode(
            ['usuario' => $request->usuario],
            env('JWT_KEY')
        );

        return ['access_token' => $token, 
            'tenant' => $empresa->base, 
            'domain' => $empresa->dominio
        ];
    }
}