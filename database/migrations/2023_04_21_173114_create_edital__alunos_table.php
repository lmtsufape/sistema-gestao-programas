<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditalAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edital__alunos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_aluno');
            $table->string('titulo_edital');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->double('valor_bolsa');
            $table->string('bolsa');
            $table->text('info_complementares');
            $table->foreignId('aluno_id');
            $table->foreignId('edital_id');
            $table->foreignId('disciplina_id');
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
        Schema::dropIfExists('edital__alunos');
    }
}
