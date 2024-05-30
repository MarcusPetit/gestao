<?php

namespace App\Http\Controllers;

use App\Models\SiteContato;
use Illuminate\Http\Request;
use App\Models\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request)
    {

        $motivo_contatos = MotivoContato::all();


        return view('contato', ['titulo' => 'Contato (teste)', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request)
    {

        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'email',
            'motivo' => 'required|string',
            'mensagem' => 'required|string',
        ]);
        SiteContato::create($request->all());
        return redirect()->route('index');
    }
}
