<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Boards",
 *     description="API Endpoints para gestionar tableros Kanban"
 * )
 */
class BoardController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/boards",
     *     tags={"Boards"},
     *     summary="Obtener todos los tableros",
     *     description="Retorna una lista de todos los tableros con sus columnas y tareas",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de tableros obtenida exitosamente",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="nombre", type="string", example="Desarrollo Web Laravel"),
     *                 @OA\Property(property="descripcion", type="string", example="Proyecto de desarrollo de aplicación web con Laravel"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time"),
     *                 @OA\Property(property="columns", type="array",
     *                     @OA\Items(
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="board_id", type="integer", example=1),
     *                         @OA\Property(property="titulo", type="string", example="Backlog"),
     *                         @OA\Property(property="color", type="string", example="#FF6B6B"),
     *                         @OA\Property(property="posicion", type="integer", example=1),
     *                         @OA\Property(property="tasks", type="array",
     *                             @OA\Items(
     *                                 @OA\Property(property="id", type="integer", example=1),
     *                                 @OA\Property(property="nombre", type="string", example="Configurar autenticación"),
     *                                 @OA\Property(property="prioridad", type="string", example="alta"),
     *                                 @OA\Property(property="avance", type="integer", example=75),
     *                                 @OA\Property(property="status", type="string", example="En curso")
     *                             )
     *                         )
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return Board::with('columns.tasks')->get();
    }

    /**
     * @OA\Post(
     *     path="/api/boards",
     *     tags={"Boards"},
     *     summary="Crear un nuevo tablero",
     *     description="Crea un nuevo tablero Kanban",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre"},
     *             @OA\Property(property="nombre", type="string", example="Nuevo Tablero Kanban", maxLength=255),
     *             @OA\Property(property="descripcion", type="string", example="Descripción detallada del tablero de trabajo")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tablero creado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nombre", type="string", example="Nuevo Tablero Kanban"),
     *             @OA\Property(property="descripcion", type="string", example="Descripción detallada del tablero"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        return Board::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/boards/{id}",
     *     tags={"Boards"},
     *     summary="Obtener un tablero específico",
     *     description="Retorna un tablero específico con sus columnas y tareas",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del tablero",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tablero obtenido exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nombre", type="string", example="Desarrollo Web Laravel"),
     *             @OA\Property(property="descripcion", type="string", example="Proyecto de desarrollo de aplicación web con Laravel"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time"),
     *             @OA\Property(property="columns", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="board_id", type="integer", example=1),
     *                     @OA\Property(property="titulo", type="string", example="Backlog"),
     *                     @OA\Property(property="color", type="string", example="#FF6B6B"),
     *                     @OA\Property(property="posicion", type="integer", example=1),
     *                     @OA\Property(property="tasks", type="array",
     *                         @OA\Items(
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="column_id", type="integer", example=1),
     *                             @OA\Property(property="nombre", type="string", example="Configurar autenticación"),
     *                             @OA\Property(property="descripcion", type="string", example="Implementar sistema completo de login y registro"),
     *                             @OA\Property(property="fecha_asignacion", type="string", format="date", example="2025-10-07"),
     *                             @OA\Property(property="fecha_limite", type="string", format="date", example="2025-10-15"),
     *                             @OA\Property(property="asignador", type="string", example="Project Manager"),
     *                             @OA\Property(property="responsable", type="string", example="Juan Pérez"),
     *                             @OA\Property(property="avance", type="integer", example=75),
     *                             @OA\Property(property="prioridad", type="string", example="alta"),
     *                             @OA\Property(property="total_days", type="integer", example=8),
     *                             @OA\Property(property="missing_days", type="integer", example=3),
     *                             @OA\Property(property="status", type="string", example="En curso")
     *                         )
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tablero no encontrado"
     *     )
     * )
     */
    public function show(Board $board)
    {
        return $board->load('columns.tasks');
    }

    /**
     * @OA\Put(
     *     path="/api/boards/{id}",
     *     tags={"Boards"},
     *     summary="Actualizar un tablero",
     *     description="Actualiza la información de un tablero específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del tablero",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nombre", type="string", example="Tablero Actualizado", maxLength=255),
     *             @OA\Property(property="descripcion", type="string", example="Nueva descripción detallada del tablero")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tablero actualizado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tablero no encontrado"
     *     )
     * )
     */
    public function update(Request $request, Board $board)
    {
        $board->update($request->all());
        return $board;
    }

    /**
     * @OA\Delete(
     *     path="/api/boards/{id}",
     *     tags={"Boards"},
     *     summary="Eliminar un tablero",
     *     description="Elimina un tablero específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del tablero",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Tablero eliminado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tablero no encontrado"
     *     )
     * )
     */
    public function destroy(Board $board)
    {
        $board->delete();
        return response()->noContent();
    }
}