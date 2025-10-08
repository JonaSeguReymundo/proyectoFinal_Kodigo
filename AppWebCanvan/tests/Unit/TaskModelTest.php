<?php

namespace Tests\Unit;

use App\Models\Task;
use Carbon\Carbon;
use Tests\TestCase;

class TaskModelTest extends TestCase
{
    /**
     * @test
     */
    public function test_total_days_calculation()
    {
        $task = new Task([
            'fecha_asignacion' => Carbon::parse('2024-01-01'),
            'fecha_limite' => Carbon::parse('2024-01-11'),
        ]);

        $this->assertEquals(10, $task->total_days);
    }

    /**
     * @test
     */
    public function test_missing_days_calculation()
    {
        Carbon::setTestNow(Carbon::parse('2024-01-05'));

        $task = new Task([
            'fecha_limite' => Carbon::parse('2024-01-10'),
        ]);

        $this->assertEquals(5, $task->missing_days);
    }

    /**
     * @test
     */
    public function test_status_completed()
    {
        $task = new Task(['avance' => 100]);
        $this->assertEquals('Completada', $task->status);
    }

    /**
     * @test
     */
    public function test_status_overdue()
    {
        Carbon::setTestNow(Carbon::parse('2024-01-12'));
        $task = new Task([
            'avance' => 50,
            'fecha_asignacion' => Carbon::parse('2024-01-01'),
            'fecha_limite' => Carbon::parse('2024-01-10'),
        ]);
        $this->assertEquals('Vencida', $task->status);
    }

    /**
     * @test
     */
    public function test_status_at_risk()
    {
        Carbon::setTestNow(Carbon::parse('2024-01-09'));
        $task = new Task([
            'avance' => 80,
            'fecha_asignacion' => Carbon::parse('2024-01-01'),
            'fecha_limite' => Carbon::parse('2024-01-10'),
        ]);
        $this->assertEquals('Por vencer', $task->status);
    }

    /**
     * @test
     */
    public function test_status_delayed()
    {
        Carbon::setTestNow(Carbon::parse('2024-01-08'));
        $task = new Task([
            'avance' => 20,
            'fecha_asignacion' => Carbon::parse('2024-01-01'),
            'fecha_limite' => Carbon::parse('2024-01-10'),
        ]);
        $this->assertEquals('Retrasada', $task->status);
    }

    /**
     * @test
     */
    public function test_status_on_going()
    {
        Carbon::setTestNow(Carbon::parse('2024-01-03'));
        $task = new Task([
            'avance' => 10,
            'fecha_asignacion' => Carbon::parse('2024-01-01'),
            'fecha_limite' => Carbon::parse('2024-01-10'),
        ]);
        $this->assertEquals('En curso', $task->status);
    }
}