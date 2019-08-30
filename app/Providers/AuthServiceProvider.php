<?php

namespace App\Providers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            $authorizationHeader = $request->header('Authorization');
            try{
                $token = str_replace('JWT ', '', $authorizationHeader);
                $dadosAutenticacao = JWT::decode($token, env('APP_KEY'), ['HS256']);
            }catch(Exception $e){
                return response()->json([
                    'error' => 'Provided token is expired.'
                ], 403);
            }
            
            return User::where('user_id', $dadosAutenticacao->sub->user_id)->first();
        });
    }
}
