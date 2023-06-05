<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramaservidorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programa_servidors', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            
            $table->foreign('programa_id')->references('id')->on('programas');
            $table->unsignedBigInteger('programa_id');
            // $table->foreignId('programa_id')->nullable(false)->constrained('programas');

            $table->foreign('servidor_id')->references('id')->on('servidors');
            $table->unsignedBigInteger('servidor_id');
            // $table->foreignId('servidor_id')->nullable(false)->constrained('servidors');
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
