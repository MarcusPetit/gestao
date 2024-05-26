<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('filiais')) {
            Schema::create('filiais', function (Blueprint $table) {
                $table->id();
                $table->string('filial', 30);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('produto_filiais')) {
            Schema::create('produto_filiais', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('filiais_id');
                $table->unsignedBigInteger('produto_id');
                $table->decimal('preco_venda', 8, 2);
                $table->integer('estoque_minimo');
                $table->integer('estoque_maximo');
                $table->timestamps();

                //foreign
                $table->foreign('filiais_id')->references('id')->on('filiais');
                $table->foreign('produto_id')->references('id')->on('produtos');
            });
        }


        if (!Schema::hasTable('produtos')) {

            Schema::table('produtos', function (Blueprint $table) {
                $table->dropColumn(['preco_venda', 'estoque_minimo', 'estoque_maximo']);
            });
        }
    }

    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->decimal('preco_venda', 8, 2);
            $table->integer('estoque_minimo');
            $table->integer('estoque_maximo');
        });

        Schema::dropIfExists('produto_filiais');

        Schema::dropIfExists('filiais');
    }
};
