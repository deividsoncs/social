<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('conteudo_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->longText('texto');
            $table->dateTime('data');
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('comentarios', function(Blueprint $table){
            $table->foreign('conteudo_id')->references('id')->on('conteudos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
}
