<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            $table->string('nome_aluno');
            $table->string('cpf', 14)->unique();
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->unsignedBigInteger('curso_id');
            // $table->foreignId('curso_id')->nullable(false)->constrained('cursos');
            $table->string('semestre_entrada', 6);
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
        Schema::dropIfExists('alunos');
    }
}
