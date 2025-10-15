<?php

namespace Database\Factories;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlunoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'curso_id' => Curso::inRandomOrder()->first()->id,
            'semestre_entrada' => $this->faker->numberBetween(2020, 2026) . '.' . $this->faker->randomElement([1, 2]),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($aluno) {
            $aluno->user()->create([
                'name' => $this->faker->name(),
                'email' => $this->faker->unique()->safeEmail(),
                'password' => bcrypt('password'),
                'cpf' => $this->faker->unique()->numerify('###.###.###-##'),
            ])->assignRole('estudante');
        });
    }
}
