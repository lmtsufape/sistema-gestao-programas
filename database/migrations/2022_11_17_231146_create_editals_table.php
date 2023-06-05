<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editals', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            $table->text('descricao');
            $table->string("semestre");
            $table->date("data_inicio");
            $table->date("data_fim");
            $table->string('titulo_edital');
            $table->string('valor_bolsa');
            
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
            $table->unsignedBigInteger('disciplina_id');
            // $table->foreignId('disciplina_id')->nullable(false)->constrained('disciplinas');
            
            $table->foreign('programa_id')->references('id')->on('programas');
            $table->unsignedBigInteger('programa_id');
            // $table->foreignId('programa_id')->nullable(false)->constrained('programas');
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
        Schema::dropIfExists('editals');
    }
}
