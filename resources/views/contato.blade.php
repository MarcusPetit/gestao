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
        </ul>
    </div>
</div>

<div class="conteudo-pagina">
    <div class="titulo-pagina">
        <h1>Entre em contato conosco</h1>
    </div>

    <div class="informacao-pagina">
        <div class="contato-principal">
            <form action={{ route('contato') }} method="post">
                @csrf
                <input type="text" name='nome' value="{{old('nome')}}" placeholder="Nome" class="borda-preta">
                <br>
                <input type="text" name='telefone' value="{{old('telefone')}}" placeholder="Telefone" class="borda-preta">
                <br>
                <input type="email" name='email' value="{{old('email')}}" placeholder="E-mail" class="borda-preta">
                <br>
                <select name='motivo' class="borda-preta">
                    <option value="">Qual o motivo do contato?</option>
                    <option value="1" {{ old('motivo') == 1 ? 'selected' : '' }}>Dúvida</option>
                    <option value="2" {{ old('motivo') == 2 ? 'selected' : '' }}>Elogio</option>
                    <option value="3" {{ old('motivo') == 3 ? 'selected' : '' }}>Reclamação</option>
                </select>
                <br>

                <textarea name="mensagem" class="black">{{ (old('mensagem') != '') ? old('mensagem') : 'Preencha aqui a sua mensagem' }}</textarea>

                <br>
                <button type="submit" class="borda-preta">ENVIAR</button>
            </form>
            <div style="position: absolute; top: 0px; left: 0px; width: 100%; background: red; ">
                <pre>
                {{print_r($errors)}}
                </pre>
            </div>
        </div>
    </div>
</div>

<div class="rodape">
    <div class="redes-sociais">
        <h2>Redes sociais</h2>
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
