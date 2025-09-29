<?php

namespace Database\Factories;

use App\Models\Aluno;
use App\Models\Edital;
use App\Models\Orientador;
use Illuminate\Database\Eloquent\Factories\Factory;

class EditalAlunoOrientadorsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(4),
            'data_inicio' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'data_fim' => $this->faker->dateTimeBetween('now', '+1 year'),
            'bolsa' => $this->faker->randomFloat(2, 400, 2000),
            'plano_projeto' => $this->faker->text(200),
            'outros_documentos' => $this->faker->text(150),
            'bolsista' => $this->faker->boolean(),
            'info_complementares' => $this->faker->paragraph(),
            'termo_compromisso_aluno' => 'termo_compromisso_aluno.pdf',
            'aluno_id' => Aluno::factory(),
            'edital_id' => Edital::inRandomOrder()->first()->id,
            'orientador_id' => Orientador::inRandomOrder()->first()->id,
        ];
    }
}
