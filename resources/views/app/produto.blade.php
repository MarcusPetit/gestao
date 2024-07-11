@extends('app.layouts.basico')
@section('titulo', 'Produto')

@section('conteudo')
    <div class="topo">

        <div class="logo">
            <img src="{{ asset('img/logo.png') }}">
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('index') }}">Principal</a></li>
                <li><a href="{{ route('sobre') }}">Sobre Nós</a></li>
                <li><a href="{{ route('produto.index') }}">Produtos</a></li>
                <li><a href="{{ route('contato') }}">Contato</a></li>
            </ul>
        </div>
    </div>
    <br>
    <br><br><br>Produto
@endsection
