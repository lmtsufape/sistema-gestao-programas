<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_systems', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('api_token')->nullable();        // criptografado
            $table->string('api_token_last4')->nullable(); // para exibição
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('rotated_at')->nullable();
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
        Schema::dropIfExists('external_systems');
    }
}
