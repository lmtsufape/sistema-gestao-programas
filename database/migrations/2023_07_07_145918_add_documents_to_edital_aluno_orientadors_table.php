<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentsToEditalAlunoOrientadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('edital_aluno_orientadors', function (Blueprint $table) {
            $table->string('termo_orientador')->nullable();
            $table->string('termo_aluno')->nullable();
            $table->string('historico_escolar')->nullable();
            $table->string('comprovante_bancario')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('edital_aluno_orientadors', function (Blueprint $table) {
            $table->dropColumn('termo_orientador');
            $table->dropColumn('termo_aluno');
            $table->dropColumn('historico_escolar');
            $table->dropColumn('comprovante_bancario');
        });
    }
}
