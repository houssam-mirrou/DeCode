<?php

namespace App\Models;

class Livrable {
    private int $id;
    private string $url;
    private string $date_submitted;
    private string $comment;
    public function __construct($id,$url,$comment,$date_submitted)
    {
        $this->id=$id;
        $this->url=$url;
        $this->date_submitted=$date_submitted;
        $this->comment = $comment;
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
    public function get_comment(){
        return $this->comment;
    }
}
