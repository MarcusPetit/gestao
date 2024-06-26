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
            <p>Listar</p>
        </div>

        <div class="menu">
            <ul>
                <il><a href="{{route('app.fornecedor.adicionar')}}">Novo</a></il>
                <il><a href="{{route('app.fornecedor')}}">Pesquisar</a></il>
            </ul>

        </div>
        <div class="informacao-pagina">
            <div class="informacao-pagina-inputs">
              ..listar

            </div>

        </div>
    </div>
@endsection
