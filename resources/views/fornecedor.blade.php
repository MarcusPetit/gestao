<h1>
    Fornecedor
</h1>


@if(count($fornecedor) > 0 && count($fornecedor) < 10) <h3>existe algum fornecedor</h3>
    @elseif (count($fornecedor) > 10)
    <h3>Existe varios fornecedores</h3>
    @else
    <h3>Ainda nao existem fornecedores cadastrados</h3>
    @endif
