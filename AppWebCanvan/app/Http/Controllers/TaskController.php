<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Tasks",
 *     description="API Endpoints para gestionar tareas dentro de las columnas"
 * )
 */
class TaskController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     tags={"Tasks"},
     *     summary="Obtener todas las tareas",
     *     description="Retorna una lista de todas las tareas",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de tareas obtenida exitosamente",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="nombre", type="string", example="Implementar login"),
     *                 @OA\Property(property="descripcion", type="string", example="Crear sistema de autenticación"),
     *                 @OA\Property(property="column_id", type="integer", example=1),
     *                 @OA\Property(property="fecha_asignacion", type="string", format="date", example="2025-10-05"),
     *                 @OA\Property(property="fecha_limite", type="string", format="date", example="2025-10-15"),
     *                 @OA\Property(property="asignador", type="string", example="Tech Lead"),
     *                 @OA\Property(property="responsable", type="string", example="Juan Pérez"),
     *                 @OA\Property(property="avance", type="integer", example=75, minimum=0, maximum=100),
     *                 @OA\Property(property="prioridad", type="string", example="alta", enum={"baja", "media", "alta", "urgente"}),
     *                 @OA\Property(property="total_days", type="integer", example=10, description="Días totales para completar la tarea"),
     *                 @OA\Property(property="missing_days", type="integer", example=3, description="Días restantes para la fecha límite"),
     *                 @OA\Property(property="status", type="string", example="En progreso", description="Estado calculado basado en fechas y avance"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * @OA\Post(
     *     path="/api/tasks",
     *     tags={"Tasks"},
     *     summary="Crear una nueva tarea",
     *     description="Crea una nueva tarea en una columna específica",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "column_id", "fecha_asignacion", "fecha_limite", "asignador", "responsable", "prioridad"},
     *             @OA\Property(property="nombre", type="string", example="Nueva tarea", maxLength=255),
     *             @OA\Property(property="descripcion", type="string", example="Descripción detallada de la tarea"),
     *             @OA\Property(property="column_id", type="integer", example=1),
     *             @OA\Property(property="fecha_asignacion", type="string", format="date", example="2025-10-05"),
     *             @OA\Property(property="fecha_limite", type="string", format="date", example="2025-10-15"),
     *             @OA\Property(property="asignador", type="string", example="Tech Lead", maxLength=255),
     *             @OA\Property(property="responsable", type="string", example="Juan Pérez", maxLength=255),
     *             @OA\Property(property="avance", type="integer", example=0, minimum=0, maximum=100),
     *             @OA\Property(property="prioridad", type="string", example="media", enum={"baja", "media", "alta", "urgente"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tarea creada exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nombre", type="string", example="Nueva tarea"),
     *             @OA\Property(property="descripcion", type="string", example="Descripción de la tarea"),
     *             @OA\Property(property="column_id", type="integer", example=1),
     *             @OA\Property(property="fecha_asignacion", type="string", format="date", example="2025-10-05"),
     *             @OA\Property(property="fecha_limite", type="string", format="date", example="2025-10-15"),
     *             @OA\Property(property="asignador", type="string", example="Tech Lead"),
     *             @OA\Property(property="responsable", type="string", example="Juan Pérez"),
     *             @OA\Property(property="avance", type="integer", example=0),
     *             @OA\Property(property="prioridad", type="string", example="media"),
     *             @OA\Property(property="total_days", type="integer", example=10),
     *             @OA\Property(property="missing_days", type="integer", example=10),
     *             @OA\Property(property="status", type="string", example="Pendiente"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Errores de validación",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="nombre", type="array", @OA\Items(type="string", example="El campo nombre es obligatorio.")),
     *                 @OA\Property(property="prioridad", type="array", @OA\Items(type="string", example="La prioridad seleccionada es inválida."))
     *             )
     *         )
     *     )
     * )
     */
    public function store(StoreTaskRequest $request)
    {
        return Task::create($request->validated());
    }

    /**
     * @OA\Get(
     *     path="/api/tasks/{id}",
     *     tags={"Tasks"},
     *     summary="Obtener una tarea específica",
     *     description="Retorna una tarea específica por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la tarea",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tarea obtenida exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nombre", type="string", example="Implementar login"),
     *             @OA\Property(property="descripcion", type="string", example="Crear sistema de autenticación"),
     *             @OA\Property(property="column_id", type="integer", example=1),
     *             @OA\Property(property="fecha_asignacion", type="string", format="date", example="2025-10-05"),
     *             @OA\Property(property="fecha_limite", type="string", format="date", example="2025-10-15"),
     *             @OA\Property(property="asignador", type="string", example="Tech Lead"),
     *             @OA\Property(property="responsable", type="string", example="Juan Pérez"),
     *             @OA\Property(property="avance", type="integer", example=75),
     *             @OA\Property(property="prioridad", type="string", example="alta"),
     *             @OA\Property(property="total_days", type="integer", example=10),
     *             @OA\Property(property="missing_days", type="integer", example=3),
     *             @OA\Property(property="status", type="string", example="En progreso"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tarea no encontrada"
     *     )
     * )
     */
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * @OA\Put(
     *     path="/api/tasks/{id}",
     *     tags={"Tasks"},
     *     summary="Actualizar una tarea",
     *     description="Actualiza la información de una tarea específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la tarea",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nombre", type="string", example="Tarea actualizada"),
     *             @OA\Property(property="descripcion", type="string", example="Nueva descripción"),
     *             @OA\Property(property="column_id", type="integer", example=2),
     *             @OA\Property(property="fecha_asignacion", type="string", format="date", example="2025-10-05"),
     *             @OA\Property(property="fecha_limite", type="string", format="date", example="2025-10-20"),
     *             @OA\Property(property="asignador", type="string", example="Project Manager"),
     *             @OA\Property(property="responsable", type="string", example="María García"),
     *             @OA\Property(property="avance", type="integer", example=50),
     *             @OA\Property(property="prioridad", type="string", example="alta", enum={"baja", "media", "alta", "urgente"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tarea actualizada exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tarea no encontrada"
     *     )
     * )
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return $task;
    }

    /**
     * @OA\Delete(
     *     path="/api/tasks/{id}",
     *     tags={"Tasks"},
     *     summary="Eliminar una tarea",
     *     description="Elimina una tarea específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la tarea",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Tarea eliminada exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tarea no encontrada"
     *     )
     * )
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->noContent();
    }
}