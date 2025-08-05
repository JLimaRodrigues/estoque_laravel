<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id_produto');
            $table->string('nome_produto');
            $table->integer('quantidade')->default(0);
            $table->decimal('custo', 8, 2);
            $table->decimal('valor', 8, 2);
            $table->unsignedInteger('tipo_produto_id');
            $table->unsignedInteger('produto_pai_id')->nullable();
            $table->timestamps();

            $table->foreign('tipo_produto_id')->references('id_tipo_produto')->on('tipo_produto');
            $table->foreign('produto_pai_id')->references('id_produto')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
