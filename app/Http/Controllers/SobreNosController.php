<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LogAcessoMiddleware;

class SobreNosController extends Controller
{
    protected $middleware = ['auth', LogAcessoMiddleware::class];

    public function sobreNos()
    {
        return view('sobre');
    }
}
