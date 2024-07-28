<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Unidade;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $produtos = Produto::with(['produtoDetalhe', 'fornecedor'])->paginate(10);

        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidades = Unidade::all();

        return view('app.produto.create', ['unidades' => $unidades]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [
            'name' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:1000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',

        ];
        $feedbacks = [
            'required' => 'O campo nome deve ser preenchido',
            'name.min' => 'Limite minimo para preencher',
            'name.max' => 'Limite maximo para preencher',
            'descricao.min' => 'Limite minimo para preencher',
            'descricao.max' => 'Limite maximo para preencher',
            'peso.integer' => 'Deve ser um inteiro',
            'unidade_id.exists' => 'Unidade de medida informada nao existe',

        ];

        $request->validate($regras, $feedbacks);

        $produto = new Produto;
        $produto->name = $request->name;

        $produto->descricao = $request->descricao;
        $produto->peso = $request->peso;
        $produto->unidade_id = $request->unidade_id;

        $produto->save();

        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        return view('app.produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        $unidades = Unidade::all();

        return view('app.produto.create', ['produto' => $produto, 'unidades' => $unidades]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $produto->update($request->all());

        return redirect()->route('produto.show', ['produto' => $produto]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produto.index');
    }
}
