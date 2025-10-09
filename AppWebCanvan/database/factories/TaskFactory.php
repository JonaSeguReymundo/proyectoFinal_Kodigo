<?php

namespace Database\Factories;

use App\Enums\TaskPriority;
use App\Models\Column;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'column_id' => Column::factory(),
            'nombre' => $this->faker->sentence,
            'descripcion' => $this->faker->paragraph,
            'fecha_asignacion' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'fecha_limite' => $this->faker->dateTimeBetween('now', '+1 month'),
            'asignador' => $this->faker->name,
            'responsable' => $this->faker->name,
            'avance' => $this->faker->numberBetween(0, 100),
            'prioridad' => $this->faker->randomElement(TaskPriority::cases()),
        ];
    }
}