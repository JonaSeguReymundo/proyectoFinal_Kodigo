<?php

namespace Tests\Feature;

use App\Enums\TaskPriority;
use App\Models\Column;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    private Column $column;

    protected function setUp(): void
    {
        parent::setUp();
        $this->column = Column::factory()->create();
    }

    private function getValidTaskData(array $overrides = []): array
    {
        return array_merge([
            'column_id' => $this->column->id,
            'nombre' => 'Test Task',
            'descripcion' => 'Test Description',
            'fecha_asignacion' => '2024-01-01',
            'fecha_limite' => '2024-01-10',
            'asignador' => 'Manager',
            'responsable' => 'Developer',
            'avance' => 50,
            'prioridad' => TaskPriority::MEDIA->value,
        ], $overrides);
    }

    /**
     * @test
     */
    public function it_can_create_a_task_with_valid_data()
    {
        $taskData = $this->getValidTaskData();

        $response = $this->postJson('/api/tasks', $taskData);

        $response->assertStatus(201)
            ->assertJsonFragment(['nombre' => 'Test Task']);

        $this->assertDatabaseHas('tasks', ['nombre' => 'Test Task']);
    }

    /**
     * @test
     */
    public function it_returns_a_validation_error_when_creating_a_task_with_invalid_data()
    {
        $taskData = $this->getValidTaskData(['nombre' => '', 'fecha_limite' => '2023-12-31']);

        $response = $this->postJson('/api/tasks', $taskData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['nombre', 'fecha_limite']);
    }

    /**
     * @test
     */
    public function it_can_update_a_task_with_valid_data()
    {
        $task = Task::factory()->create(['column_id' => $this->column->id]);
        $updateData = $this->getValidTaskData(['nombre' => 'Updated Task Name']);

        $response = $this->putJson("/api/tasks/{$task->id}", $updateData);

        $response->assertStatus(200)
            ->assertJsonFragment(['nombre' => 'Updated Task Name']);

        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'nombre' => 'Updated Task Name']);
    }

    /**
     * @test
     */
    public function it_returns_a_validation_error_when_updating_a_task_with_invalid_data()
    {
        $task = Task::factory()->create(['column_id' => $this->column->id]);
        $updateData = $this->getValidTaskData(['prioridad' => 'invalid-priority']);

        $response = $this->putJson("/api/tasks/{$task->id}", $updateData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['prioridad']);
    }

    /**
     * @test
     */
    public function it_can_delete_a_task()
    {
        $task = Task::factory()->create(['column_id' => $this->column->id]);

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}