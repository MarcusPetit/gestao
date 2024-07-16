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
            <p>Editar Produto</p>
        </div>

        <div class="menu">
            <ul>
                <il><a href="{{ route('produto.index') }}">Voltar</a></il>
                <il><a href="">Pesquisar</a></il>
            </ul>

        </div>

        <div class = 'informacao-pagina'>
            <div class = " width: 90%; margin-left: margin-rigt: auto;">


                <div class="informacao-pagina">
                    {{ $msg ?? '' }}
                    <div style="width: 30%; margin-left: auto; margin-right: auto;">
                        <form method="post" action="{{ route('produto.update', ['produto' => $produto->id]) }}">
                            <input type="hidden" name="id" value = "">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" value="{{ $produto->name ?? old('name') }}"
                                placeholder="Nome" class="borda-preta">
                            {{ $errors->has('name') ? $errors->first('name') : '' }}

                            <input type="text" name="descricao" value="{{ $produto->descricao ?? old('descricao') }}"
                                placeholder="Descricao" class="borda-preta">
                            {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}

                            <input type="text" name="peso" value="{{ $produto->peso ?? old('peso') }}"
                                placeholder="Peso" class="borda-preta">
                            {{ $errors->has('peso') ? $errors->first('peso') : '' }}
                            <select name="unidade_id" id="unidade_id">
                                <option value="">-- Selecione a Unidade de Medida --</option>

                                @foreach ($unidades as $unidade)
                                    <option value="{{ $unidade->id }}"
                                        {{ ($produto->unidade_id ?? old('unidade_id')) == $unidade->id ? 'selected' : '' }}>
                                        {{ $unidade->descricao }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="borda-preta">Cadastrar</button>

                        </form>
                    </div>
                </div>

                <div class="paginate">
                </div>


            </div>
        </div>


    </div>
@endsection
