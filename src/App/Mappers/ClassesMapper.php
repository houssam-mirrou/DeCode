<?php
namespace App\Mappers;

use App\Models\ClassRoom;

class ClassesMapper {
    public static function map_class($class){
        $new_class = new ClassRoom($class['id'],$class['name'],$class['school_year']);
        return $new_class;
    }
}