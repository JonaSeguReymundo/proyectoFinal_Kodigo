<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Columns",
 *     description="API Endpoints para gestionar columnas de los tableros Kanban"
 * )
 */
class ColumnController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/columns",
     *     tags={"Columns"},
     *     summary="Obtener todas las columnas",
     *     description="Retorna una lista de todas las columnas con sus tareas",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de columnas obtenida exitosamente",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="board_id", type="integer", example=1),
     *                 @OA\Property(property="titulo", type="string", example="Backlog"),
     *                 @OA\Property(property="color", type="string", example="#FF6B6B"),
     *                 @OA\Property(property="posicion", type="integer", example=1),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time"),
     *                 @OA\Property(property="tasks", type="array",
     *                     @OA\Items(
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="nombre", type="string", example="Configurar autenticación"),
     *                         @OA\Property(property="prioridad", type="string", example="alta"),
     *                         @OA\Property(property="avance", type="integer", example=75),
     *                         @OA\Property(property="status", type="string", example="En curso")
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return Column::with('tasks')->get();
    }

    /**
     * @OA\Post(
     *     path="/api/columns",
     *     tags={"Columns"},
     *     summary="Crear una nueva columna",
     *     description="Crea una nueva columna en un tablero",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"titulo", "board_id"},
     *             @OA\Property(property="board_id", type="integer", example=1),
     *             @OA\Property(property="titulo", type="string", example="En Progreso", maxLength=255),
     *             @OA\Property(property="color", type="string", example="#4ECDC4"),
     *             @OA\Property(property="posicion", type="integer", example=2)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Columna creada exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="board_id", type="integer", example=1),
     *             @OA\Property(property="titulo", type="string", example="En Progreso"),
     *             @OA\Property(property="color", type="string", example="#4ECDC4"),
     *             @OA\Property(property="posicion", type="integer", example=2),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        return Column::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/columns/{id}",
     *     tags={"Columns"},
     *     summary="Obtener una columna específica",
     *     description="Retorna una columna específica con sus tareas",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la columna",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Columna obtenida exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="board_id", type="integer", example=1),
     *             @OA\Property(property="titulo", type="string", example="Backlog"),
     *             @OA\Property(property="color", type="string", example="#FF6B6B"),
     *             @OA\Property(property="posicion", type="integer", example=1),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time"),
     *             @OA\Property(property="tasks", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="column_id", type="integer", example=1),
     *                     @OA\Property(property="nombre", type="string", example="Configurar autenticación"),
     *                     @OA\Property(property="descripcion", type="string", example="Implementar sistema completo de login"),
     *                     @OA\Property(property="fecha_asignacion", type="string", format="date", example="2025-10-07"),
     *                     @OA\Property(property="fecha_limite", type="string", format="date", example="2025-10-15"),
     *                     @OA\Property(property="asignador", type="string", example="Project Manager"),
     *                     @OA\Property(property="responsable", type="string", example="Juan Pérez"),
     *                     @OA\Property(property="avance", type="integer", example=75),
     *                     @OA\Property(property="prioridad", type="string", example="alta"),
     *                     @OA\Property(property="total_days", type="integer", example=8),
     *                     @OA\Property(property="missing_days", type="integer", example=3),
     *                     @OA\Property(property="status", type="string", example="En curso")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Columna no encontrada"
     *     )
     * )
     */
    public function show(Column $column)
    {
        return $column->load('tasks');
    }

    /**
     * @OA\Put(
     *     path="/api/columns/{id}",
     *     tags={"Columns"},
     *     summary="Actualizar una columna",
     *     description="Actualiza la información de una columna específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la columna",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="titulo", type="string", example="Completado", maxLength=255),
     *             @OA\Property(property="color", type="string", example="#45B7D1"),
     *             @OA\Property(property="posicion", type="integer", example=3)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Columna actualizada exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Columna no encontrada"
     *     )
     * )
     */
    public function update(Request $request, Column $column)
    {
        $column->update($request->all());
        return $column;
    }

    /**
     * @OA\Delete(
     *     path="/api/columns/{id}",
     *     tags={"Columns"},
     *     summary="Eliminar una columna",
     *     description="Elimina una columna específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la columna",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Columna eliminada exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Columna no encontrada"
     *     )
     * )
     */
    public function destroy(Column $column)
    {
        $column->delete();
        return response()->noContent();
    }
}