<?php

namespace App\Enums;

enum TaskPriority: string
{
    case BAJA = 'baja';
    case MEDIA = 'media';
    case ALTA = 'alta';
    case URGENTE = 'urgente';
}