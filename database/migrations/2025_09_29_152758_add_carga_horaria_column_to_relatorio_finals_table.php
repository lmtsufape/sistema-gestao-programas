<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCargaHorariaColumnToRelatorioFinalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('relatorio_finals', function (Blueprint $table) {
            $table->integer('carga_horaria')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('relatorio_finals', function (Blueprint $table) {
            $table->dropColumn('carga_horaria');
        });
    }
}
