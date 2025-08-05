<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItensRequisicaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_requisicoes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('requisicao_id');
            $table->unsignedInteger('produto_id');
            $table->integer('quantidade');
            $table->decimal('valor_unitario', 8, 2);
            $table->timestamps();

            $table->foreign('requisicao_id')->references('id_requisicao')->on('requisicoes')->onDelete('cascade');
            $table->foreign('produto_id')->references('id_produto')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itens_requisicoes');
    }
}
