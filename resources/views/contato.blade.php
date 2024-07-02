@extends('layouts.basico')
@section('contato_conteudo')
    <div class="topo">

        <div class="logo">
            <img src="img/logo.png">
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('index') }}">Principal</a></li>
                <li><a href="{{ route('sobre') }}">Sobre Nós</a></li>
                <li><a href="{{ route('contato') }}">Contato</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
            </ul>
        </div>
    </div>

    <div class="conteudo-pagina">
        <div class="titulo-pagina">
            <h1>Entre em contato conosco</h1>
        </div>


        <div class="informacao-pagina">
            <div class="contato-principal">
                @component('layouts.formulario', [
                    'classe' => 'borda-branca',
                    'motivo_contatos' => $motivo_contatos,
                    'route' => route('contato'),
                ])
                @endcomponent
            </div>
        </div>
    </div>

    <div>


    </div>
    <div class="rodape">
        <div class="redes-sociais">
            <h2>Redes sociais</:TSInstall php_onlyh2>
                <img src="img/facebook.png">
                <img src="img/linkedin.png">
                <img src="img/youtube.png">
        </div>
        <div class="area-contato">
            <h2>Contato</h2>
            <span>(11) 3333-4444</span>
            <br>
            <span>supergestao@dominio.com.br</span>
        </div>
        <div class="localizacao">
            <h2>Localização</h2>
            <img src="img/mapa.png">
        </div>
    </div>
@endsection
