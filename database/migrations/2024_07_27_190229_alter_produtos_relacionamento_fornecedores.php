<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            // Remover a chave estrangeira existente, se houver
            $table->dropForeign(['fornecedor_id']);

            // Certificar-se de que a coluna não existe antes de adicioná-la
            if (! Schema::hasColumn('produtos', 'fornecedor_id')) {
                $table->unsignedBigInteger('fornecedor_id')->after('id')->default(1); // Temporário padrão para evitar erro
            }

            // Adicionar chave estrangeira
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores')->onDelete('cascade');
        });

        // Atualizar todos os produtos para ter um fornecedor válido
        $fornecedor_id = DB::table('fornecedores')->insertGetId([
            'nome' => 'Fornecedor para nao da erro',
            'site' => 'fornecedor.com.br',
            'uf' => 'SP',
            'email' => 'contato@fornecedor.com.br',
        ]);

        DB::table('produtos')->update(['fornecedor_id' => $fornecedor_id]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign(['fornecedor_id']);
            $table->dropColumn('fornecedor_id');
        });
    }
};
