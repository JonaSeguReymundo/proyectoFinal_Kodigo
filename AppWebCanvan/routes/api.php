<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\TaskController;

Route::apiResource('boards', BoardController::class);
Route::apiResource('columns', ColumnController::class);
Route::apiResource('tasks', TaskController::class);