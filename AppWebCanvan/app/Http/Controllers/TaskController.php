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
     *                 @OA\Property(property="title", type="string", example="Implementar login"),
     *                 @OA\Property(property="description", type="string", example="Crear sistema de autenticación"),
     *                 @OA\Property(property="column_id", type="integer", example=1),
     *                 @OA\Property(property="position", type="integer", example=1),
     *                 @OA\Property(property="priority", type="string", example="high", enum={"low", "medium", "high"}),
     *                 @OA\Property(property="due_date", type="string", format="date", example="2025-10-15"),
     *                 @OA\Property(property="status", type="string", example="pending", enum={"pending", "in_progress", "completed"}),
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
     *             required={"title", "column_id"},
     *             @OA\Property(property="title", type="string", example="Nueva tarea"),
     *             @OA\Property(property="description", type="string", example="Descripción de la tarea"),
     *             @OA\Property(property="column_id", type="integer", example=1),
     *             @OA\Property(property="position", type="integer", example=1),
     *             @OA\Property(property="priority", type="string", example="medium", enum={"low", "medium", "high"}),
     *             @OA\Property(property="due_date", type="string", format="date", example="2025-10-15"),
     *             @OA\Property(property="status", type="string", example="pending", enum={"pending", "in_progress", "completed"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tarea creada exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Nueva tarea"),
     *             @OA\Property(property="description", type="string", example="Descripción de la tarea"),
     *             @OA\Property(property="column_id", type="integer", example=1),
     *             @OA\Property(property="position", type="integer", example=1),
     *             @OA\Property(property="priority", type="string", example="medium"),
     *             @OA\Property(property="due_date", type="string", format="date", example="2025-10-15"),
     *             @OA\Property(property="status", type="string", example="pending"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
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
     *             @OA\Property(property="title", type="string", example="Implementar login"),
     *             @OA\Property(property="description", type="string", example="Crear sistema de autenticación"),
     *             @OA\Property(property="column_id", type="integer", example=1),
     *             @OA\Property(property="position", type="integer", example=1),
     *             @OA\Property(property="priority", type="string", example="high"),
     *             @OA\Property(property="due_date", type="string", format="date", example="2025-10-15"),
     *             @OA\Property(property="status", type="string", example="pending"),
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
     *             @OA\Property(property="title", type="string", example="Tarea actualizada"),
     *             @OA\Property(property="description", type="string", example="Nueva descripción"),
     *             @OA\Property(property="column_id", type="integer", example=2),
     *             @OA\Property(property="position", type="integer", example=2),
     *             @OA\Property(property="priority", type="string", example="high", enum={"low", "medium", "high"}),
     *             @OA\Property(property="due_date", type="string", format="date", example="2025-10-20"),
     *             @OA\Property(property="status", type="string", example="in_progress", enum={"pending", "in_progress", "completed"})
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