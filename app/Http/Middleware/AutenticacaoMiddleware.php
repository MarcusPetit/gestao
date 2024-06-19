<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $modelo_metodo, $perfil): Response
    {
        if ($modelo_metodo == 'padrao') {

            echo 'validando parametro <br>'.$perfil;
        }

        if (false) {
            return $next($request);
        } else {

            return Response('Acesso negado! Rota exige autenticacao');

        }
    }
}
