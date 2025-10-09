<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];

    public function columns()
    {
        return $this->hasMany(Column::class);
    }
}