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
                <li><a href="{{ route('app.sair') }}">Sair</a></li>
            </ul>
        </div>
    </div>

    <div class ="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Fornecedor Editar</p>
        </div>
    @endsection
