<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrequenciaMensalAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequencia_mensal_alunos', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            $table->foreign('edital_aluno_orientador_id')->references('id')->on('edital_aluno_orientadors');
            $table->unsignedBigInteger('edital_aluno_orientador_id');
            $table->string('frequencia_mensal');
            $table->date('data');
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
        Schema::dropIfExists('frequencia_mensal_alunos');
    }
}
