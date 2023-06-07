<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrientadorCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orientador_cursos', function (Blueprint $table) {
            #$table->id();            
            $table->foreign('orientador_id')->references('id')->on('orientadors');
            $table->unsignedBigInteger('orientador_id');

            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->unsignedBigInteger('curso_id');

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
        Schema::dropIfExists('orientador_cursos');
    }
}
