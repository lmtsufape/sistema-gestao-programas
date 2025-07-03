<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatorioFinalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorio_finals', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(1);
            $table->String('caminho');
            $table->foreignId('edital_aluno_orientador_id')->constrained('edital_aluno_orientadors');
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
        Schema::dropIfExists('relatorio_finals');
    }
}
