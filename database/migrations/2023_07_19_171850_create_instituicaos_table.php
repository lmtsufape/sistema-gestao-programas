<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituicaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituicaos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('instituicao');
            $table->string('sigla');
            $table->string('cnpj',14)->unique();
            $table->string('natureza_juridica');
            $table->string('endereco');
            $table->string('numero');
            $table->string('complemento');
            $table->string('CEP',8)->unique();
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado');
            $table->string('representante');
            $table->string('cargo_representante');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instituicaos');
    }
}
