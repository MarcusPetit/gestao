@extends('app.layouts.basico')

@section('titulo', 'Cliente')

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

    <br><br><br><br>Cliente
@endsection
