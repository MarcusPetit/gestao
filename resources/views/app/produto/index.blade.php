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
            <p>Produto Listar</p>
        </div>

        <div class="menu">
            <ul>
                <il><a href="{{ route('produto.create') }}">Criar</a></il>
                <il><a href="">Pesquisar</a></il>
            </ul>

        </div>

        <div class = 'informacao-pagina'>
            <div class = " width: 90%; margin-left: margin-rigt: auto;">


                <table border='1' width=100%>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Peso</th>
                            <th>Unidade ID</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->name }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->peso }}</td>
                                <td>{{ $produto->unidade_id }}</td>
                                <td><a href="">Excluir</a></td>
                                <td><a href="">Editar</a></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="paginate">
                    {{ $produtos->appends($request)->links() }}
                </div>





            </div>
        </div>


    </div>
@endsection
