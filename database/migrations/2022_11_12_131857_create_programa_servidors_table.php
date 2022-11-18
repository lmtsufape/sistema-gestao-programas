<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramaServidorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programa_servidors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_programa')->nullable(false)->constrained('programas');
            $table->foreignId('id_servidor')->nullable(false)->constrained('servidors');
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
        Schema::dropIfExists('programa_servidors');
    }
}
