<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatorioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorios', function (Blueprint $table) {
            $table->softDeletes();
            $table->id();
            $table->enum('status',['pendente','enviado', 'avaliado','aprovado','reprovado', 'arquivado'])->default('pendente')->nullable();
            $table->string('observacao');
            $table->string('tipo');
            $table->string('relatorio');
            $table->foreignId('edital_aluno_orientadors_id')->contrained('edital_aluno_orientadors');
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
        Schema::dropIfExists('relatorio');
    }
}
