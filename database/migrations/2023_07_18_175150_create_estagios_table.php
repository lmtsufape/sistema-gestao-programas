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
            $table->boolean('status')->default(false);
            $table->string('descricao');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->date('data_solicitacao');
            $table->enum('tipo', ['eo', 'eno'])->default('eo');

            /*$table->foreign('aluno_id')->references('id')->on('alunos');
            $table->unsignedBigInteger('aluno_id');

            $table->foreign('orientador_id')->references('id')->on('orientadors');
            $table->unsignedBigInteger('orientador_id');*/
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
