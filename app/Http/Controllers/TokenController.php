<?php
namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function gerarToken(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $usuario = User::where('email', $request->email)->where('password', hash('sha512', $request->password))->first();
        //return response()->json(['PWD' => hash('sha512', $request->password)], 401);
        //$pwd = hash('sha512', $request->password)." >> ".$usuario->password;
        //return response()->json($usuario, 401);

        if (is_null($usuario)) {
            return response()->json(['erro' => 'Usuário ou senha inválidos'], 401);
        }

        $payload = [
            'iss' => "token", // Issuer of the token
            'sub' => $usuario, // Subject of the token
            'iat' => time(), // Time when JWT was issued. 
            'exp' => time() + 60 * 60 // Expiration time
        ];

        $token = JWT::encode(
            $payload,
            env('APP_KEY')
        );

        return [
            'token' => $token
        ];
    }
}
