<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id', 'fornecedor_id'];

    public function produtoDetalhe(): HasOne
    {
        return $this->hasOne(ProdutoDetalhe::class, 'produto_id');

    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id');
    }

    public function pedidos() {
        return $this->belongsToMany(Pedido::class , 'pedidos_produtos' , 'produto_id' , 'pedido_id' );
    }
}
