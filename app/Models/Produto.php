<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'descricao', 'peso', 'unidade_id'];

    public function produtoDetalhe(): HasOne
    {
        return $this->hasOne(ProdutoDetalhe::class, 'produto_id');

    }
}
