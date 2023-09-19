<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDataFromListaDocumentosObrigatorios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lista_documentos_obrigatorios', function (Blueprint $table) {
            $table->dropColumn('data_envio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lista_documentos_obrigatorios', function (Blueprint $table) {
            $table->date('data_envio')->nullable();
        });
    }
}
