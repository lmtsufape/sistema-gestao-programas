<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoDisciplinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_disciplinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_curso')->nullable(false)->constrained('cursos');
            $table->foreignId('id_disciplina')->nullable(false)->constrained('disciplinas');
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
        Schema::dropIfExists('curso_disciplinas');
    }
}
