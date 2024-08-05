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
                <li><a href="{{ route('pedido.index') }}">Pedido</a></li>
                <li><a href="{{ route('produto.index') }}">Produtos</a></li>
                <li><a href="{{ route('app.sair') }}">Sair</a></li>
            </ul>
        </div>
    </div>

    <div class ="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Listagem de Perdidos </p>
        </div>

        <div class="menu">
            <ul>
                <il><a href="{{ route('pedido.create') }}">Criar</a></il>
                <il><a href="">Pesquisar</a></il>
            </ul>

        </div>

        <div class = 'informacao-pagina'>
            <div class = "width: 90%; margin-left: margin-rigt: auto;">

                <table border='1' width=100%>
                    <thead>
                        <tr>
                            <th>ID Pedido</th>

                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($pedidos as $pedido)
                            <tr>
                                <td>{{ $pedido->nome }}</td>
                                <td><a href="{{ route('pedido.show', ['pedido' => $pedido->id]) }}">Visualisar</a></td>
                                <td>
                                    <form id="form_{{ $pedido->id }}" method="post"
                                        action="{{ route('pedido.destroy', ['pedido' => $pedido->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <!--<button type="submit">Excluir</button>-->
                                        <a href="#"
                                            onclick="document.getElementById('form_{{ $pedido->id }}').submit()">Excluir</a>
                                    </form>
                                </td>
                                <td><a href="{{ route('pedido.edit', ['pedido' => $pedido->id]) }}">Editar</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="paginate">
                    {{ $pedidos->appends($request)->links() }}
                </div>
            </div>
        </div>


    </div>
@endsection
