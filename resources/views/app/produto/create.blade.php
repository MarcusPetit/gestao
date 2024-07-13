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
            <p>Adicionar Produto</p>
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
                        <form method="post" action="{{ route('app.fornecedor.adicionar') }}">
                            <input type="hidden" name="id" value = "">
                            @csrf
                            <input type="text" name="name" value="" placeholder="Nome" class="borda-preta">

                            <input type="text" name="descricao" value="" placeholder="Descricao"
                                class="borda-preta">

                            <input type="text" name="peso" value="" placeholder="Peso" class="borda-preta">
                            <select name="unidade_is" id="">
                                <option value="">-- Selecione a Unidade de Medida --</option>

                                @foreach ($unidades as $unidade)
                                    <option value="{{ $unidade->id }}">{{ $unidade->descricao }}</option>
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
