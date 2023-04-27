<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAndDropColumnsToTableEditalOrientadors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('edital_orientadors', function (Blueprint $table) {
            $table->dropForeign('edital_orientadors_id_edital_foreign');
            $table->dropColumn('id_edital');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('edital_orientadors', function (Blueprint $table) {
            $table->foreignId('id_edital')->nullable(false)->constrained('editals');
        });
    }
}
