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
            $table->id();
            $table->foreignId('id_edital')->nullable(false)->constrained('editals');
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
        Schema::dropIfExists('edital_disciplinas');
    }
}
