<?php
namespace App\Http\Middleware;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class Autenticado
{
    public function handle(Request $request, \Closure $next)
    {
        try {
            if (!$request->hasHeader('Authorization')) {
                throw new \Exception();
            }
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('JWT ', '', $authorizationHeader);
            $dadosAutenticacao = JWT::decode($token, env('APP_KEY'), ['HS256']);
            $user = User::select('user_id')->where('user_id', $dadosAutenticacao->sub->user_id)->first();
            //print_r($user);die;
            if (is_null($user)) {
                throw new \Exception();
            }

            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['erro' => 'Não autorizado'], 401);
        }
    }
}