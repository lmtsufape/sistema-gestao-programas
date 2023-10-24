<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstituicaoToListaDocumentosObrigatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lista_documentos_obrigatorios', function (Blueprint $table) {
            $table->string('instituicao')->nullable('false');
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
            $table->dropColumn('instituicao');
        });
    }
}
