<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUniqueConstraintFromDocumentosEstagiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documentos_estagios', function (Blueprint $table) {
            $table->dropForeign(['lista_documentos_obrigatorios_id']);
            $table->dropUnique(['lista_documentos_obrigatorios_id']);
            $table->foreign('lista_documentos_obrigatorios_id')->references('id')->on('lista_documentos_obrigatorios');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documentos_estagios', function (Blueprint $table) {
            $table->unique('lista_documentos_obrigatorios_id');
        });
    }
}
