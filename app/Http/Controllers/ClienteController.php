<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('app.cliente.index', ['clientes' => $clientes = DB::table('clientes')->paginate(10) , 'request' =>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:40'
        ];
        $feedback = [
            'required' => 'O nome tem que ter preenchido',
            'nome.min'=> ' O campo nome tem que ter mínimo 3 caracteres',
            'nome.max' => 'O campo nome tem que ter máximo 40 caracteres',
        ];
        $request->validate($regras , $feedback);

        $cliente = new Cliente();
        $cliente->nome = $request->nome;
        $cliente->save();

        return redirect()->route('cliente.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
