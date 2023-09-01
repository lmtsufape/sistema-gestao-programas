<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDocumentosEstagiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_estagios', function (Blueprint $table) {
            $table->id();
            //$table->date('data');
            $table->timestamps();

            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('lista_documentos_obrigatorios_id')->unique();

            $table->foreign('aluno_id')->references('id')->on('alunos');

            $table->foreign('lista_documentos_obrigatorios_id')->references('id')->on('lista_documentos_obrigatorios');
        });
        if (config('database.default') === 'mysql') {
            DB::statement("SET GLOBAL max_allowed_packet=32777216;");
            DB::statement("ALTER TABLE documentos_estagios ADD pdf MEDIUMBLOB");
        }
        
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos_estagios');
    }
}
