{{ $slot }}
<form action={{ $route }} method="post">
    @csrf
    <input name="nome" value="{{ old('nome') }}" type="text" placeholder="Nome" class=borda_branca>
    <br>
    <input name="telefone" value="{{ old('telefone') }}" type="text" placeholder="Telefone" class=borda_branca>
    <br>
    <input name="email" value="{{ old('email') }}" type="text" placeholder="E-mail" class=borda_branca>
    <br>

    <select name="motivo_contato_id" class=borda_branca>
        <option value="">Qual o motivo do contato?</option>

        @foreach($motivo_contatos as $key => $motivo_contato)
        <option value="{{$motivo_contato->id}}" {{ old('motivo_contato-id') == $motivo_contato->id ? 'selected' : '' }}>{{$motivo_contato->motivo_contato}}</option>
        @endforeach
    </select>
    <br>
    <textarea name="mensagem" class=borda_branca>{{ (old('mensagem') != '') ? old('mensagem') : 'Preencha aqui a sua mensagem' }}</textarea>
    <br>
    <button type="submit" class=borda_branca>ENVIAR</button>
</form>

<div style="position:absolute; top:0px; width:100%; background:red">
    <pre>
    {{ print_r($errors) }}
    </pre>
</div>
