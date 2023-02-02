<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTipoServidorToServidorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servidors', function (Blueprint $table) {
            $table->foreignId('id_tipo_servidor')->nullable(false)->constrained('tipo_servidors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servidors', function (Blueprint $table) {
            $table->dropForeign('servidors_id_tipo_servidor_foreign');
            $table->dropColumn('id_tipo_servidor');
        });
    }
}
