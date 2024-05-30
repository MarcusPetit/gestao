<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlterTableSiteContatosAddFkMotivoContatos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Adicionando a coluna motivo_contatos_id
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->unsignedBigInteger('motivo_contatos_id')->after('id'); // Ajuste a posição se necessário
        });

        // Atribuindo motivo para a nova coluna motivo_contatos_id
        DB::statement('UPDATE site_contatos SET motivo_contatos_id = motivo');

        // Criando a chave estrangeira
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->foreign('motivo_contatos_id')->references('id')->on('motivo_contatos');
        });

        // Removendo a coluna motivo
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->dropColumn('motivo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Criar a coluna motivo
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->integer('motivo');
        });

        // Atribuindo motivo_contatos_id para a coluna motivo
        DB::statement('UPDATE site_contatos SET motivo = motivo_contatos_id');

        // Removendo a chave estrangeira
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->dropForeign('site_contatos_motivo_contatos_id_foreign');
        });

        // Removendo a coluna motivo_contatos_id
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->dropColumn('motivo_contatos_id');
        });
    }
}

