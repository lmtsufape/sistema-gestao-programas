<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrequenciaMensalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequencia_mensals', function (Blueprint $table) {
            $table->id();
            $table->string('mes')->nullable(false);
            $table->json('frequencia')->nullable(false);
            $table->float('tempo_total')->nullable(false);
            $table->enum('status', ['enviada', 'aprovada', 'recusada'])->default('enviada')->nullable(false);
            $table->string('observacao')->nullable();
            $table->foreignId('id_edital_aluno')->nullable(false)->constrained('edital_alunos');
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
        Schema::dropIfExists('frequencia_mensals');
    }
}
