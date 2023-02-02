<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnTipoServidorToServidorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servidors', function (Blueprint $table) {
            $table->dropColumn('tipo_servidor');
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
            $table->enum("tipo_servidor", ['adm', 'pro_reitor', 'servidor'])->nullable(false);
        });
    }
}
