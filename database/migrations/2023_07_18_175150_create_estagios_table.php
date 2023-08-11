<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstagiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estagios', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            $table->timestamps();
            $table->boolean('status');
            $table->text('descricao');
            $table->string('cpf_aluno');
            $table->date('data_inicio');
            $table->date('data_fim');
            //$table->date('data_solicitacao');
            $table->enum('tipo', ['eo', 'eno']);

            $table->foreign('cpf_aluno')->references('cpf')->on('alunos');
            //$table->unsignedBigInteger('cpf');
            
            $table->unsignedBigInteger('orientador_id');
            $table->foreign('orientador_id')->references('id')->on('orientadors');
            
            $table->unsignedBigInteger('curso_id');
            $table->foreign('curso_id')->references('id')->on('cursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estagios');
    }
}
