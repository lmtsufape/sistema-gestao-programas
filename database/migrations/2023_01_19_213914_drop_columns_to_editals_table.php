<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsToEditalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('editals', function (Blueprint $table) {
            $table->dropForeign('editals_id_curso_foreign');
            $table->dropColumn('id_curso');
            $table->dropColumn('semestre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('editals', function (Blueprint $table) {
            //
        });
    }
}
