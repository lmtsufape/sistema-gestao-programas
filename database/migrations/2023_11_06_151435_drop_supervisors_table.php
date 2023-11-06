<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('supervisors');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('supervisors', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            $table->string('nome');
            $table->string('cpf', 14)->unique();
            $table->string('email', 100)->unique();
            $table->string('telefone');
            $table->string('formacao');
            $table->timestamps();
        });
    }
}
