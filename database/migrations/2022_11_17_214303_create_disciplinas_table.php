<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplinas', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            $table->string('nome')->nullable(false);
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->unsignedBigInteger('curso_id');
            // $table->foreignId('curso_id')->nullable(false)->constrained('cursos');

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
        Schema::dropIfExists('disciplinas');
    }
}
