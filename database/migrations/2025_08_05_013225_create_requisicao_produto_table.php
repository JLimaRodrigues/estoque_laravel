<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisicaoProdutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisicao_produto', function (Blueprint $table) {
            $table->increments('id_requisicao_produto');
            $table->unsignedInteger('requisicao_id');
            $table->unsignedInteger('produto_id');
            $table->integer('quantidade');
            $table->timestamps();

            $table->foreign('requisicao_id')->references('id_requisicao')->on('requisicoes');
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
        Schema::dropIfExists('requisicao_produto');
    }
}
