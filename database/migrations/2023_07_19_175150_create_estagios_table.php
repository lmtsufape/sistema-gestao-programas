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
            $table->boolean('status')->default(True);
            $table->text('descricao');
            //$table->string('cpf_aluno');
            $table->date('data_inicio');
            $table->date('data_fim');
            //$table->date('data_solicitacao');
            $table->enum('tipo', ['eo', 'eno']);

            //$table->foreign('cpf_aluno')->references('cpf')->on('alunos');
            //$table->unsignedBigInteger('cpf');

            $table->unsignedBigInteger('aluno_id');
            $table->foreign('aluno_id')->references('id')->on('alunos');

            $table->unsignedBigInteger('orientador_id');
            $table->foreign('orientador_id')->references('id')->on('orientadors');
            
            $table->unsignedBigInteger('curso_id');
            $table->foreign('curso_id')->references('id')->on('cursos');

            $table->unsignedBigInteger('disciplina_id')->nullable(true);
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');

            $table->unsignedBigInteger('supervisor_id');
            $table->foreign('supervisor_id')->references('id')->on('supervisors');

            $table->unsignedBigInteger('instituicao_id')->default(1);
            $table->foreign('instituicao_id')->references('id')->on('instituicaos');
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
