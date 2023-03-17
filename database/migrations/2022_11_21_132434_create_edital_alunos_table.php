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
        Schema::create('edital_alunos', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable(false);
            $table->foreignId('id_edital')->nullable(true)->constrained('editals');
            $table->foreignId('id_aluno')->nullable(true)->constrained('alunos');
            $table->string('bolsa')->nullable(true);
            $table->string('valor_bolsa')->nullable(true);
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
