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
            <p>Fornecedor Listar</p>
        </div>

        <div class="menu">
            <ul>
                <il><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></il>
                <il><a href="{{ route('app.fornecedor') }}">Pesquisar</a></il>
            </ul>

        </div>

        <div class = 'informacao-pagina'>
            <div class = " width: 90%; margin-left: margin-rigt: auto;">


                <table border='1' width=100%>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Site</th>
                            <th>UF</th>
                            <th>Email</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($fornecedores as $fornecedor)
                            <tr>
                                <td>{{ $fornecedor->nome }}</td>
                                <td>{{ $fornecedor->site }}</td>
                                <td>{{ $fornecedor->uf }}</td>
                                <td>{{ $fornecedor->email }}</td>
                                <td>{{ $fornecedor->nome }}</td>
                                <td>Excluir</td>
                                <td><a href="{{ route('app.fornecedor.editar', $fornecedor->id) }}">Editar</a></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>


            </div>
        </div>


    </div>
@endsection
