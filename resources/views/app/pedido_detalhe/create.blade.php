@extends('app.layouts.basico')

@section('conteudo')
    <div class="topo">

        <div class="logo">
            <img src="{{ asset('img/logo.png') }}">
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('app.home') }}">Home</a></li>
                <li><a href="{{ route('cliente.index') }}">Clientes</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Fornecedor</a></li>
                <li><a href="{{ route('produto.index') }}">Produtos</a></li>
                <li><a href="{{ route('app.sair') }}">Sair</a></li>
            </ul>
        </div>
    </div>

    <div class ="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Adicionar Produto Pedidos </p>
        </div>
        <div class="menu">
            <ul>
                <il><a href="{{ route('pedido.index') }}">Voltar</a></il>
                <il><a href="">Pesquisar</a></il>
            </ul>

        </div>

        <div class="informacao-pagina">
            <h4>Detalhe do pedido</h4>
            <p>ID do pedido {{ $pedido->id }}</p>
            <p>ID do Cliente {{ $pedido->cliente_id }}</p>
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                @component('app.pedido_detalhe._components.form_create_edit', ['pedido' => $pedido, 'produtos' => $produtos])
                @endcomponent

            </div>
        </div>

    </div>
@endsection
