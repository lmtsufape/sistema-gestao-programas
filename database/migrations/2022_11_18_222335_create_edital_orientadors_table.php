<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditalOrientadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edital_orientadors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_edital')->nullable(false)->constrained('editals');
            $table->foreignId('id_orientador')->nullable(false)->constrained('orientadors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edital_orientadors');
    }
}
