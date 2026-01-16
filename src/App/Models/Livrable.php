<?php

namespace App\Models;

class Livrable {
    private int $id;
    private string $url;
    private string $date_submitted;
    public function __construct($id,$url,$date_submitted)
    {
        $this->id=$id;
        $this->url=$url;
        $this->date_submitted=$date_submitted;
    }

    public function get_id(){
        return $this->id;
    }
    public function get_url(){
        return $this->url;
    }
    public function get_date_submitted(){
        return $this->date_submitted;
    }
}
