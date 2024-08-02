<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
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
        $produtos = Produto::with(["produtoDetalhe", "fornecedor"])->paginate(
            10
        );

        return view("app.produto.index", [
            "produtos" => $produtos,
            "request" => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();

        return view("app.produto.create", [
            "unidades" => $unidades,
            "fornecedores" => $fornecedores,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [
            "nome" => "required|min:3|max:40",
            "descricao" => "required|min:3|max:1000",
            "peso" => "required|integer",
            "unidade_id" => "exists:unidades,id",
            "fornecedor_id" => "exists:fornecedores,id",

        ];
        $feedbacks = [
            "required" => "O campo nome deve ser preenchido",
            "nome.min" => "Limite minimo para preencher",
            "nome.max" => "Limite maximo para preencher",
            "descricao.min" => "Limite mínimo para preencher",
            "descricao.max" => "Limite máximo para preencher",
            "peso.integer" => "Deve ser um inteiro",
            "unidade_id.exists" => "Unidade de medida informada nao existe",
            "fornecedores_id.exists" => "Fornecedor nao existe",
        ];

        $request->validate($regras, $feedbacks);

        $produto = new Produto();
        $produto->nome = $request->nome;

        $produto->descricao = $request->descricao;
        $produto->peso = $request->peso;
        $produto->unidade_id = $request->unidade_id;
        $produto->fornecedor_id = $request->fornecedor_id;

        $produto->save();

        return redirect()->route("produto.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        return view("app.produto.show", ["produto" => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produto = Produto::find($id);
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();

        return view("app.produto.edit", [
            "produto" => $produto,
            "unidades" => $unidades,
            "fornecedores" => $fornecedores,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $regras = [
            "nome" => "required|min:3|max:40",
            "descricao" => "required|min:3|max:1000",
            "peso" => "required|integer",
            "unidade_id" => "exists:unidades,id",
            "fornecedor_id" => "exists:fornecedores,id",
        ];
        $feedbacks = [
            "required" => "O campo nome deve ser preenchido",
            "nome.min" => "Limite mínimo para preencher",
            "nome.max" => "Limite máximo para preencher",
            "descricao.min" => "Limite mínimo para preencher",
            "descricao.max" => "Limite máximo para preencher",
            "peso.integer" => "Deve ser um inteiro",
            "unidade_id.exists" => "Unidade de medida informada nao existe",
            "fornecedores_id.exists" => "Fornecedor nao existe",
        ];

        $request->validate($regras, $feedbacks);
        $produto->update($request->all());

        return redirect()
            ->route("produto.show", ["produto" => $produto])
            ->with("success", "Produto atualizado com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route("produto.index");
    }
}
