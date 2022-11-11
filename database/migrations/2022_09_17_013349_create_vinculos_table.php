<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVinculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vinculos', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['ANDAMENTO', 'CONCLUIDA', 'CANCELADA'])->default('ANDAMENTO')->nullable();
            $table->enum('bolsa', ['REMUNERADA', 'VOLUNTARIA'])->nullable(false);
            $table->float('valor_bolsa')->nullable();
            $table->enum('programa', ['PAVI', 'BIA', 'PET', 'MONITORIA', 'TUTORIA'])->nullable(false);
            $table->string("disciplina")->nullable();
            $table->string("relatorio")->nullable();
            $table->enum('status_relatorio', ['ENVIADO', 'APROVADO', 'REPROVADO'])->nullable();
            $table->string("observacao_relatorio")->nullable();
            $table->string("curso")->nullable();
            $table->string("semestre")->nullable(false);
            $table->date("data_inicio")->nullable(false);
            $table->date("data_fim")->nullable(false);
            $table->integer('quantidade_horas')->default(0);
            $table->timestamps();
        });

        Schema::table('vinculos', function ($table) {
            $table->foreignId('aluno_id')->constrained('alunos');
            $table->foreignId('professor_id')->constrained('professors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vinculos');
    }
}
