<?php

namespace App\Models;

use App\Enums\TaskPriority;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'column_id', 'nombre', 'descripcion',
        'fecha_asignacion', 'fecha_limite',
        'asignador', 'responsable',
        'avance', 'prioridad'
    ];

    protected $casts = [
        'prioridad' => TaskPriority::class,
        'fecha_asignacion' => 'date',
        'fecha_limite' => 'date',
    ];

    protected $appends = ['total_days', 'missing_days', 'status'];

    public function column()
    {
        return $this->belongsTo(Column::class);
    }

    /**
     * @return Attribute
     */
    protected function totalDays(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->fecha_limite->diff($this->fecha_asignacion)->days
        );
    }

    /**
     * @return Attribute
     */
    protected function missingDays(): Attribute
    {
        return Attribute::make(
            get: fn () => max(0, now()->startOfDay()->diffInDays($this->fecha_limite->startOfDay(), false))
        );
    }

    /**
     * @return Attribute
     */
    protected function status(): Attribute
    {
        return Attribute::make(get: function () {
            if ($this->avance >= 100) {
                return 'Completada';
            }

            $missingDays = $this->missing_days;

            if ($missingDays <= 0) {
                return 'Vencida';
            }

            $totalDays = $this->total_days;
            
            if ($totalDays == 0) {
                return $missingDays > 0 ? 'En curso' : 'Vencida';
            }

            $daysPassed = $totalDays - $missingDays;

            if ($daysPassed <= 0) {
                return 'En curso';
            }

            $expectedProgress = ($daysPassed / $totalDays) * 100;

            if ($this->avance < $expectedProgress - 15) {
                return 'Retrasada';
            }

            if ($missingDays <= 2) {
                return 'Por vencer';
            }

            return 'En curso';
        });
    }
}