<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = ['nombre', 'descripcion'];

    public function columns()
    {
        return $this->hasMany(Column::class);
    }
}