@extends('app.layouts.basico')

@section('conteudo')
    <div class="topo">

        <div class="logo">
            <img src="{{ asset('img/logo.png') }}">
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('app.home') }}">Home</a></li>
                <li><a href="{{ route('app.cliente') }}">Clientes</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Fornecedor</a></li>
                <li><a href="{{ route('produto.index') }}">Produtos</a></li>
                <li><a href="{{ route('app.sair') }}">Sair</a></li>
            </ul>
        </div>
    </div>

    <div class ="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Editar Detalhes Produto</p>
        </div>

        <div class="menu">
            <ul>
                <il><a href="">Voltar</a></il>

            </ul>
        </div>

        <div class="informacao-pagina">
            <h4>Produto</h4>
            <div>Nome: {{ $produto_detalhe->produto->name }}</div>
            <div>Descricao: {{ $produto_detalhe->produto->descricao }} </div>
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                @component('app.produto_detalhe._components.form_create_edit', [
                    'produto_detalhe' => $produto_detalhe,
                    'unidades' => $unidades,
                ])
                @endcomponent
            </div>
        </div>
    </div>
@endsection
