<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditalAlunoOrientadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edital_aluno_orientadors', function (Blueprint $table) {
            $table->softDeletes();
            $table->bigIncrements('id');
            $table->string('titulo');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->string('bolsa');
            $table->string('plano_projeto');
            $table->boolean('bolsista');
            $table->text('info_complementares');
            $table->string('termo_compromisso_aluno');
            $table->foreignId('aluno_id')->contrained('alunos');
            $table->foreignId('edital_id')->contrained('editals');
            $table->foreignId('disciplina_id')->contrained('disciplinas');
            $table->foreignId('orientador_id')->contrained('orientadors');
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
        Schema::dropIfExists('edital_alunos');
    }
}
