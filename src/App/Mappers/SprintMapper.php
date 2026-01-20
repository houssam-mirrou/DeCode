<?php

namespace App\Mappers;

use App\Models\Sprint;

class SprintMapper
{
    public static function map_sprint($sprint)
    {
        return new Sprint($sprint['id'], $sprint['name'], 
                $sprint['start_date'], $sprint['end_date'], $sprint['class_id']);
    }
}
