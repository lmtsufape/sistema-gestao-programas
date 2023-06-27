<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoVinculoAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_vinculo_alunos', function (Blueprint $table) {
            $table->softDeletes();

            $table->id();

            $table->foreign('vinculo_id')->references('id')->on('edital_aluno_orientadors');
            $table->unsignedBigInteger('vinculo_id');

            $table->date('data_inicio');
            $table->date('data_fim')->nullable(true);

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
        Schema::dropIfExists('historico_vinculo_alunos');
    }
}
