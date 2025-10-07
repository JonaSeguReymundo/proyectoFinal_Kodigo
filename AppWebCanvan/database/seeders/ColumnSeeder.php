<?php

namespace Database\Seeders;

use App\Models\Column;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColumnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Columnas para el tablero "Desarrollo Web Laravel" (board_id: 1)
        $developmentColumns = [
            ['titulo' => 'Backlog', 'board_id' => 1, 'posicion' => 1, 'color' => '#e74c3c'],
            ['titulo' => 'Por Hacer', 'board_id' => 1, 'posicion' => 2, 'color' => '#f39c12'],
            ['titulo' => 'En Progreso', 'board_id' => 1, 'posicion' => 3, 'color' => '#3498db'],
            ['titulo' => 'En Revisión', 'board_id' => 1, 'posicion' => 4, 'color' => '#9b59b6'],
            ['titulo' => 'Terminado', 'board_id' => 1, 'posicion' => 5, 'color' => '#27ae60'],
        ];

        // Columnas para el tablero "Marketing Digital" (board_id: 2)
        $marketingColumns = [
            ['titulo' => 'Ideas', 'board_id' => 2, 'posicion' => 1, 'color' => '#f1c40f'],
            ['titulo' => 'Planificación', 'board_id' => 2, 'posicion' => 2, 'color' => '#e67e22'],
            ['titulo' => 'Ejecución', 'board_id' => 2, 'posicion' => 3, 'color' => '#8e44ad'],
            ['titulo' => 'Publicado', 'board_id' => 2, 'posicion' => 4, 'color' => '#2ecc71'],
        ];

        // Columnas para el tablero "Gestión de RRHH" (board_id: 3)
        $hrColumns = [
            ['titulo' => 'Solicitudes', 'board_id' => 3, 'posicion' => 1, 'color' => '#34495e'],
            ['titulo' => 'Entrevistas', 'board_id' => 3, 'posicion' => 2, 'color' => '#16a085'],
            ['titulo' => 'Capacitación', 'board_id' => 3, 'posicion' => 3, 'color' => '#2980b9'],
            ['titulo' => 'Completado', 'board_id' => 3, 'posicion' => 4, 'color' => '#27ae60'],
        ];

        $allColumns = array_merge($developmentColumns, $marketingColumns, $hrColumns);

        foreach ($allColumns as $columnData) {
            Column::create($columnData);
        }
    }
}
