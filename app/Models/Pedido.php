<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    public function produtos()  {
        return $this->belongsToMany(Produto::class , 'pedidos_produtos' , 'pedido_id' , 'produto_id');
    }
}
