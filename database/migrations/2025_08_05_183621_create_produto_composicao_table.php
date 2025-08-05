<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutoComposicaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_composicao', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('produto_composto_id');
            $table->unsignedInteger('produto_simples_id'); 
            $table->integer('quantidade');
            $table->timestamps();

            $table->foreign('produto_composto_id')
                ->references('id_produto')
                ->on('produtos')
                ->onDelete('cascade');

            $table->foreign('produto_simples_id')
                ->references('id_produto')
                ->on('produtos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto_composicao');
    }
}
