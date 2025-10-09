<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Enums\TaskPriority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tareas para el proyecto de Desarrollo Web Laravel
        $developmentTasks = [
            // Backlog (column_id: 1)
            [
                'nombre' => 'Configurar autenticación de usuarios',
                'descripcion' => 'Implementar sistema completo de login, registro y recuperación de contraseña',
                'column_id' => 1,
                'fecha_asignacion' => '2025-10-07',
                'fecha_limite' => '2025-10-15',
                'asignador' => 'Project Manager',
                'responsable' => 'Juan Pérez',
                'avance' => 0,
                'prioridad' => TaskPriority::ALTA->value
            ],
            [
                'nombre' => 'Crear sistema de notificaciones',
                'descripcion' => 'Implementar notificaciones en tiempo real usando WebSockets',
                'column_id' => 1,
                'fecha_asignacion' => '2025-10-07',
                'fecha_limite' => '2025-10-20',
                'asignador' => 'Tech Lead',
                'responsable' => 'María García',
                'avance' => 0,
                'prioridad' => TaskPriority::MEDIA->value
            ],
            
            // Por Hacer (column_id: 2)
            [
                'nombre' => 'Diseñar base de datos',
                'descripcion' => 'Crear migraciones y modelos para todas las entidades del sistema',
                'column_id' => 2,
                'fecha_asignacion' => '2025-10-05',
                'fecha_limite' => '2025-10-12',
                'asignador' => 'Architect',
                'responsable' => 'Carlos López',
                'avance' => 25,
                'prioridad' => TaskPriority::ALTA->value
            ],
            [
                'nombre' => 'Configurar API REST',
                'descripcion' => 'Crear endpoints RESTful para todas las operaciones CRUD',
                'column_id' => 2,
                'fecha_asignacion' => '2025-10-06',
                'fecha_limite' => '2025-10-14',
                'asignador' => 'Tech Lead',
                'responsable' => 'Ana Martínez',
                'avance' => 10,
                'prioridad' => TaskPriority::ALTA->value
            ],
            
            // En Progreso (column_id: 3)
            [
                'nombre' => 'Implementar frontend con Vue.js',
                'descripcion' => 'Desarrollar interfaz de usuario responsive con componentes Vue',
                'column_id' => 3,
                'fecha_asignacion' => '2025-10-04',
                'fecha_limite' => '2025-10-18',
                'asignador' => 'Frontend Lead',
                'responsable' => 'Pedro Sánchez',
                'avance' => 60,
                'prioridad' => TaskPriority::ALTA->value
            ],
            [
                'nombre' => 'Integrar Swagger/OpenAPI',
                'descripcion' => 'Documentar completamente la API con Swagger UI',
                'column_id' => 3,
                'fecha_asignacion' => '2025-10-03',
                'fecha_limite' => '2025-10-10',
                'asignador' => 'Developer',
                'responsable' => 'Luis Rodríguez',
                'avance' => 80,
                'prioridad' => TaskPriority::MEDIA->value
            ],
            
            // En Revisión (column_id: 4)
            [
                'nombre' => 'Configurar entorno de desarrollo',
                'descripcion' => 'Setup completo de Laravel, MySQL y herramientas de desarrollo',
                'column_id' => 4,
                'fecha_asignacion' => '2025-10-01',
                'fecha_limite' => '2025-10-08',
                'asignador' => 'DevOps',
                'responsable' => 'Sofia Hernández',
                'avance' => 90,
                'prioridad' => TaskPriority::MEDIA->value
            ],
            
            // Terminado (column_id: 5)
            [
                'nombre' => 'Inicializar proyecto Laravel',
                'descripcion' => 'Crear nuevo proyecto Laravel con estructura básica',
                'column_id' => 5,
                'fecha_asignacion' => '2025-09-30',
                'fecha_limite' => '2025-10-05',
                'asignador' => 'Tech Lead',
                'responsable' => 'Roberto Díaz',
                'avance' => 100,
                'prioridad' => TaskPriority::BAJA->value
            ]
        ];

        // Tareas para Marketing Digital
        $marketingTasks = [
            // Ideas (column_id: 6)
            [
                'nombre' => 'Campaña en redes sociales',
                'descripcion' => 'Estrategia de contenido para Instagram, Facebook y LinkedIn',
                'column_id' => 6,
                'fecha_asignacion' => '2025-10-07',
                'fecha_limite' => '2025-10-25',
                'asignador' => 'Marketing Manager',
                'responsable' => 'Laura Fernández',
                'avance' => 0,
                'prioridad' => TaskPriority::MEDIA->value
            ],
            
            // Planificación (column_id: 7)
            [
                'nombre' => 'Análisis de competencia',
                'descripcion' => 'Investigar estrategias y precios de la competencia',
                'column_id' => 7,
                'fecha_asignacion' => '2025-10-06',
                'fecha_limite' => '2025-10-12',
                'asignador' => 'Strategy Lead',
                'responsable' => 'David Torres',
                'avance' => 30,
                'prioridad' => TaskPriority::ALTA->value
            ],
            
            // Ejecución (column_id: 8)
            [
                'nombre' => 'Crear landing page',
                'descripcion' => 'Diseñar y desarrollar página de aterrizaje para campaña',
                'column_id' => 8,
                'fecha_asignacion' => '2025-10-02',
                'fecha_limite' => '2025-10-16',
                'asignador' => 'Creative Director',
                'responsable' => 'Carmen Ruiz',
                'avance' => 70,
                'prioridad' => TaskPriority::URGENTE->value
            ],
            
            // Publicado (column_id: 9)
            [
                'nombre' => 'Campaña Google Ads',
                'descripcion' => 'Campaña de búsqueda y display en Google Ads',
                'column_id' => 9,
                'fecha_asignacion' => '2025-09-28',
                'fecha_limite' => '2025-10-03',
                'asignador' => 'Digital Manager',
                'responsable' => 'Miguel Castro',
                'avance' => 100,
                'prioridad' => TaskPriority::MEDIA->value
            ]
        ];

        // Tareas para RRHH
        $hrTasks = [
            // Solicitudes (column_id: 10)
            [
                'nombre' => 'Contratación desarrollador Senior',
                'descripcion' => 'Buscar y entrevistar desarrollador Laravel con 5+ años de experiencia',
                'column_id' => 10,
                'fecha_asignacion' => '2025-10-05',
                'fecha_limite' => '2025-10-30',
                'asignador' => 'HR Manager',
                'responsable' => 'Elena Morales',
                'avance' => 15,
                'prioridad' => TaskPriority::URGENTE->value
            ],
            
            // Entrevistas (column_id: 11)
            [
                'nombre' => 'Entrevista candidato UX/UI',
                'descripcion' => 'Evaluación técnica y cultural de diseñador UX/UI',
                'column_id' => 11,
                'fecha_asignacion' => '2025-10-04',
                'fecha_limite' => '2025-10-11',
                'asignador' => 'Design Lead',
                'responsable' => 'Jorge Vega',
                'avance' => 50,
                'prioridad' => TaskPriority::MEDIA->value
            ],
            
            // Capacitación (column_id: 12)
            [
                'nombre' => 'Curso de Laravel para el equipo',
                'descripcion' => 'Capacitación interna sobre mejores prácticas en Laravel',
                'column_id' => 12,
                'fecha_asignacion' => '2025-10-01',
                'fecha_limite' => '2025-10-22',
                'asignador' => 'Tech Lead',
                'responsable' => 'Patricia Jiménez',
                'avance' => 40,
                'prioridad' => TaskPriority::MEDIA->value
            ],
            
            // Completado (column_id: 13)
            [
                'nombre' => 'Onboarding nuevo practicante',
                'descripcion' => 'Proceso de integración y capacitación inicial completado',
                'column_id' => 13,
                'fecha_asignacion' => '2025-09-25',
                'fecha_limite' => '2025-10-01',
                'asignador' => 'HR Coordinator',
                'responsable' => 'Andrea Silva',
                'avance' => 100,
                'prioridad' => TaskPriority::BAJA->value
            ]
        ];

        $allTasks = array_merge($developmentTasks, $marketingTasks, $hrTasks);

        foreach ($allTasks as $taskData) {
            Task::create($taskData);
        }
    }
}