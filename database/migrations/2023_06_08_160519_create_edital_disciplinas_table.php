<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditalDisciplinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edital_disciplinas', function (Blueprint $table) {
            #$table->id();
            
            $table->foreign('edital_id')->references('id')->on('editals');
            $table->unsignedBigInteger('edital_id');

            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
            $table->unsignedBigInteger('disciplina_id');

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
        Schema::dropIfExists('edital_disciplinas');
    }
}
