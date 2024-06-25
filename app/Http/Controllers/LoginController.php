<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $erro = '';

        if ($request->get('erro') == 1) {
            $erro = ' Usuario nao cadastrado';
        }
        if ($request->get('erro') == 2) {
            $erro = ' Usuario nao cadastrado';
        }

        return view('login', ['titulo' => 'login', 'erro' => $erro]);

    }

    public function autenticar(Request $request)
    {
        $regras = [
            'usuario' => 'email',
            'senha' => 'required',
        ];
        $retorno = [
            'usuario.email' => 'O campo do usuario e obrigatorio',
            'senha.required' => 'Senha obrigatoria',
        ];
        $request->validate($regras, $retorno);

        //recuperar parametros
        $email = $request->get('usuario');
        $password = $request->get('senha');

        //iniciar model user
        $user = new User();

        $usuario = $user->where('email', $email)
            ->where('password', $password)
            ->get()
            ->first();

        if (isset($usuario->name)) {
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            return redirect()->route('app.home');
        } else {

            return redirect()->route('login', ['erro' => 1]);
        }

    }

    public function sair()
    {
        session_destroy();
        return redirect()->route("index");
    }
}
