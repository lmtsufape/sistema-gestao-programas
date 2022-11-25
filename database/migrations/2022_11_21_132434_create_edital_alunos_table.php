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
            $table->foreignId('id_edital')->nullable(false)->constrained('editals');
            $table->foreignId('id_aluno')->nullable(false)->constrained('alunos');
            $table->string('bolsa')->nullable(false);
            $table->string('valor_bolsa')->nullable(false);
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
