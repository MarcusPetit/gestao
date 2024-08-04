@extends('app.layouts.basico')

@section('conteudo')
    <div class="topo">

        <div class="logo">
            <img src="{{ asset('img/logo.png') }}">
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('app.home') }}">Home</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Fornecedor</a></li>
                <li><a href="{{ route('cliente.index') }}">Clientes</a></li>
                <li><a href="{{ route('produto.index') }}">Produtos</a></li>
                <li><a href="{{ route('app.sair') }}">Sair</a></li>
            </ul>
        </div>
    </div>

    <div class ="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Listagem de cliente </p>
        </div>

        <div class="menu">
            <ul>
                <il><a href="{{ route('cliente.create') }}">Criar</a></il>
                <il><a href="">Pesquisar</a></il>
            </ul>

        </div>

        <div class = 'informacao-pagina'>
            <div class = "width: 90%; margin-left: margin-rigt: auto;">

                <table border='1' width=100%>
                    <thead>
                        <tr>
                            <th>Nome</th>

                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->nome }}</td>
                                <td><a href="{{ route('cliente.show', ['cliente' => $cliente->id]) }}">Visualisar</a></td>
                                <td>
                                    <form id="form_{{ $cliente->id }}" method="post"
                                        action="{{ route('cliente.destroy', ['cliente' => $cliente->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <!--<button type="submit">Excluir</button>-->
                                        <a href="#"
                                            onclick="document.getElementById('form_{{ $cliente->id }}').submit()">Excluir</a>
                                    </form>
                                </td>
                                <td><a href="{{ route('cliente.edit', ['cliente' => $cliente->id]) }}">Editar</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="paginate">
                    {{ $clientes->appends($request)->links() }}
                </div>





            </div>
        </div>


    </div>
@endsection
