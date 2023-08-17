<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaDocumentosObrigatorios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_documentos_obrigatorios', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descricao_documento');
            $table->date('prazo');
            $table->enum('tipo_entrega', ['inicial','final']);
            $table->enum('tipo_estagio', ['eo', 'eno']);

            $table->foreign('estagio_id')->references('id')->on('estagios');
            $table->unsignedBigInteger('estagio_id');

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
        Schema::dropIfExists('lista_documentos_obrigatorios');
    }
}
