<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToDocumentosEstagiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documentos_estagios', function (Blueprint $table) {
            $table->enum('status', ['Aprovado', 'Aguardando documento assinado', 'Aguardando verificação', 'Negado'])->default('Aguardando documento assinado');
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
            //
        });
    }
}
