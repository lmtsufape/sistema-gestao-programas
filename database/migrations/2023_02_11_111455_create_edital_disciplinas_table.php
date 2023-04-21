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
            $table->foreignId('edital_id')->nullable(false)->constrained('editals');
            $table->foreignId('disciplina_id')->nullable(false)->constrained('disciplinas');
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
