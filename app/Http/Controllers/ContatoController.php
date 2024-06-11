<?php

namespace App\Http\Controllers;

use App\Models\MotivoContato;
use App\Models\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato(Request $request)
    {
        $motivo_contatos = MotivoContato::all(); // Obter todos os motivos de contato

        return view('contato', compact('motivo_contatos')); // Passar a variável para a view
    }

    public function salvar(Request $request)
    {

        $request->validate([
            'nome' => 'required|string|max:255|unique:site_contatos',
            'telefone' => 'required|string|max:20',
            'email' => 'email',
            'motivo_contato_id' => 'required|exists:motivo_contatos,id',
            'mensagem' => 'required|string',
        ]);
        SiteContato::create($request->all());

        return redirect()->route('index');
    }
}
