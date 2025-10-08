<?php

namespace App\Http\Requests;

use App\Enums\TaskPriority;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'column_id' => ['required', 'integer', 'exists:columns,id'],
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'fecha_asignacion' => ['required', 'date'],
            'fecha_limite' => ['required', 'date', 'after_or_equal:fecha_asignacion'],
            'asignador' => ['required', 'string', 'max:255'],
            'responsable' => ['required', 'string', 'max:255'],
            'avance' => ['required', 'integer', 'min:0', 'max:100'],
            'prioridad' => ['required', new Enum(TaskPriority::class)],
        ];
    }
}