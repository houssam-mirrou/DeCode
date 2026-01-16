<?php

namespace App\Models;

class Evaluation {
    private int $id;
    private string $level;
    private string $review;
    private string $comment;
    private string $date;
    public function __construct($id,$level,$review,$comment,$date) {
        $this->id=$id;
        $this->level=$level;
        $this->review=$review;
        $this->comment=$comment;
        $this->date=$date;
    }

    public function get_id(){
        return $this->id;
    }
    public function get_level(){
        return $this->level;
    }
    public function get_review(){
        return $this->review;
    }
    public function get_comment(){
        return $this->comment;
    }
    public function get_date(){
        return $this->date;
    }

}