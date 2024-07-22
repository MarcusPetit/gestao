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

    public function listar(Request $request)
    {

        $fornecedores = Fornecedor::where('nome', 'like', '%'.$request->input('nome').'%')
            ->where('site', 'like', '%'.$request->input('site').'%')
            ->where('uf', 'like', '%'.$request->input('uf').'%')
            ->where('email', 'like', '%'.$request->input('email').'%')->simplePaginate(2);
        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request)
    {
        $msg = '';

        //incluir
        if ($request->input('_token') != '' && $request->input('id') == '') {
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

        //editar
        if ($request->input('_token') != '' && $request->input('id') != '') {
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if ($update) {
                $msg = 'updadte com sucesso';
            } else {
                $msg = 'updade sem sucesso';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id)
    {
        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor]);
    }

    public function excluir($id)
    {
        Fornecedor::find($id)->delete();
        Fornecedor::find($id)->forceDelete();

        return redirect()->route('app.fornecedor');
    }

}
