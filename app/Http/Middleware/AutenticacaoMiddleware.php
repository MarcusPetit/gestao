<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        //iniciar sessao ou recaminhar para login
        session_start();
        if (isset($_SESSION['email']) && $_SESSION['email'] != '') {
            return $next($request);

        } else {
            return redirect()->route('login', ['erro' => 2]);
        }
    }
}
