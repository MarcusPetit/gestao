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
            @if (isset($produto->id))
                <p>Editar Produto</p>
            @else
                <p>Adicionar Produto</p>
            @endif
        </div>

        <div class="menu">
            <ul>
                <il><a href="{{ route('produto.index') }}">Voltar</a></il>
                <il><a href="">Pesquisar</a></il>
            </ul>

        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">

                @if (isset($produto->id))
                    <form method="post" action="{{ route('produto.update', ['produto' => $produto->id]) }}">
                        @csrf
                        @method('PUT')
                    @else
                        <form method="post" action="{{ route('produto.store') }}">
                            @csrf
                @endif
                <input type="text" name="nome" value="{{ $produto->nome ?? old('nome') }}" placeholder="Nome"
                    class="borda-preta">
                {{ $errors->has('nome') ? $errors->first('nome') : '' }}

                <input type="text" name="descricao" value="{{ $produto->descricao ?? old('descricao') }}"
                    placeholder="Descrição" class="borda-preta">
                {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}

                <input type="text" name="peso" value="{{ $produto->peso ?? old('peso') }}" placeholder="peso"
                    class="borda-preta">
                {{ $errors->has('peso') ? $errors->first('peso') : '' }}

                <select name="unidade_id">
                    <option>-- Selecione a Unidade de Medida --</option>

                    @foreach ($unidades as $unidade)
                        <option value="{{ $unidade->id }}"
                            {{ ($produto->unidade_id ?? old('unidade_id')) == $unidade->id ? 'selected' : '' }}>
                            {{ $unidade->descricao }}</option>
                    @endforeach
                </select>
                {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}

                <button type="submit" class="borda-preta">Cadastrar</button>
                <form>
            </div>
        </div>

    </div>
@endsection
