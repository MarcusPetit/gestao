<?php

namespace Database\Seeders;

use App\Models\MotivoContato;
use Illuminate\Database\Seeder;

class MotivoContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MotivoContato::create([ 'id' => 1 , 'motivo_contato' => 'Duvida']);
        MotivoContato::create(['id' => 2 ,'motivo_contato' => 'Elogio']);
        MotivoContato::create(['id' => 3 ,'motivo_contato' => 'Reclamacao']);
    }
}
