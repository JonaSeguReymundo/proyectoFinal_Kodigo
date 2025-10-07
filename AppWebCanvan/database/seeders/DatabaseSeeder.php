<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuarios de prueba
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@kanban.com',
        ]);

        User::factory()->create([
            'name' => 'Developer',
            'email' => 'developer@kanban.com',
        ]);

        User::factory()->create([
            'name' => 'Project Manager',
            'email' => 'pm@kanban.com',
        ]);

        // Ejecutar seeders en orden
        $this->call([
            BoardSeeder::class,
            ColumnSeeder::class,
            TaskSeeder::class,
        ]);
    }
}
