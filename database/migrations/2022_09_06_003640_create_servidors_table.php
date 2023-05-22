<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateservidorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servidors', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            $table->string("cpf", 14)->unique()->nullable(false);
            $table->string('instituicaoVinculo');
            $table->integer('matricula')->unique()->nullable(false);
            $table->enum("tipo_servidor", ['adm', 'pro_reitor', 'servidor'])->nullable(false);
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
        Schema::dropIfExists('servidors');
    }
}
