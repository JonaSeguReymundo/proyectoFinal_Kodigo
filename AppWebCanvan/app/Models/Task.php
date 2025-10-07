<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'column_id', 'nombre', 'descripcion',
        'fecha_asignacion', 'fecha_limite',
        'asignador', 'responsable',
        'avance', 'prioridad'
    ];

    public function column()
    {
        return $this->belongsTo(Column::class);
    }
}