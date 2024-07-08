<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('_token') != '') {
        }

        return view('app.fornecedor.index');
    }

    public function listar()
    {
        return view('app.fornecedor.listar');
    }

    public function adicionar(Request $request)
    {
        $msg = '';

        if ($request->input('_token') != '') {
            //validando formulario para cadastro

            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email',
            ];

            //retorno da mensagem de erro
            $feedback = [
                'required' => 'O campo :atribute deve ser preenchido',
                'nome.min' => ' O campo dever ter no maximo 3 caracteres',
                'nome.max' => ' O campo dever ter no maximo 40 caracteres',
                'uf.min' => ' O campo dever ter no maximo 2 caracteres',
                'uf.max' => ' O campo dever ter no maximo 2 caracteres',
                'email.email' => ' O campo email nao foi preenchido corretamente',
            ];

            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();

            $fornecedor->create(
                $request->all()
            );

            $msg = 'Cadastro realizdo com sucesso';
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }
}
