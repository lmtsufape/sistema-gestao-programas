<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateorientadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orientadors', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            $table->string('cpf', 14)->unique()->nullable(false);
            $table->string('instituicaoVinculo');
            $table->string('curso');
            $table->string('matricula')->nullable(false);
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
        Schema::dropIfExists('orientadors');
    }
}
