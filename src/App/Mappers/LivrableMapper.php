<?php

namespace App\Mappers;

use App\Models\Livrable;

class LivrableMapper {
    public static function map_livrable($livrable){
        return new Livrable($livrable['id'],$livrable['url'],$livrable['comment'],$livrable['date_submitted']);
    }
    public static function map_livrable_info($id,$url,$comment,$date_submitted){
        return new Livrable($id,$url,$comment,$date_submitted);
    }
}