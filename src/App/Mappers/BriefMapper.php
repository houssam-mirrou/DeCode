<?php

namespace App\Mappers;

use App\Models\Brief;

class BriefMapper {
    public static function map_brief($brief){
        return new Brief($brief['id'],$brief['title'],$brief['description'],$brief['date_remise'],$brief['type'],$brief['sprint_id']);
    }
    public static function map_brief_info($id,$title,$description,$date_remise,$type,$sprint_id){
        return new Brief($id,$title,$description,$date_remise,$type,$sprint_id);
    }
}