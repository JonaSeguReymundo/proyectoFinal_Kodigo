<?php

namespace Database\Seeders;

use App\Models\Board;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $boards = [
            [
                'nombre' => 'Desarrollo Web Laravel',
                'descripcion' => 'Tablero para gestionar el desarrollo del proyecto Laravel con sistema Kanban'
            ],
            [
                'nombre' => 'Marketing Digital',
                'descripcion' => 'Campañas y estrategias de marketing para el lanzamiento del producto'
            ],
            [
                'nombre' => 'Gestión de Recursos Humanos',
                'descripcion' => 'Procesos de contratación, capacitación y desarrollo del equipo'
            ]
        ];

        foreach ($boards as $boardData) {
            Board::create($boardData);
        }
    }
}
