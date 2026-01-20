<?php

namespace App\Models;

class Sprint
{
    private int $id;
    private string $name;
    private string $start_date;
    private string $end_date;
    private int $class_id;
    public function __construct($id, $name, $start_date, $end_date, $class_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->class_id = $class_id;
    }
    public function get_id()
    {
        return $this->id;
    }
    public function get_name()
    {
        return $this->name;
    }
    public function get_start_date()
    {
        return $this->start_date;
    }
    public function get_end_date()
    {
        return $this->end_date;
    }

    public function get_class_id(){
        return $this->class_id;
    }
}
