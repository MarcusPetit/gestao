<?php

namespace App\Http\Controllers;

use App\Models\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato(Request $request)
    {

        //$contato = new SiteContato();
        //$contato->create($request->all());

        return view('contato', ['titulo' => 'Contato (teste)']);
    }

    public function salvar(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'required|string|max:255',
            'motivo' => 'required|integer',
            'mensagem' => 'required|string',
        ]);
        SiteContato::create($request->all());
        return view('contato', ['titulo' => 'Contato']);
    }
}
