<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstagioIdToDocumentosEstagiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documentos_estagios', function (Blueprint $table) {
            $table->unsignedBigInteger('estagio_id');
            $table->foreign('estagio_id')->references('id')->on('estagios');
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
            $table->dropForeign(['estagio_id']);
            $table->dropColumn('estagio_id');
        });
    }
}
