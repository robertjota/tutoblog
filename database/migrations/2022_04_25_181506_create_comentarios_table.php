<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedbigInteger('usuarios_id')->nullable();
            $table->foreign('usuarios_id', 'fk_comentarios_usuarios_id')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate('restrict');
            $table->unsignedbigInteger('posts_id');
            $table->foreign('posts_id', 'fk_comentarios_posts_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('restrict');
            $table->unsignedbigInteger('comentarios_id');
            $table->foreign('comentarios_id', 'fk_comentarios_comentarios')->references('id')->on('comentarios')->onDelete('cascade')->onUpdate('restrict');
            $table->boolean('estado')->default(0);
            $table->timestamps();
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
