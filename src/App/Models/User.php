<?php

namespace App\Models;

class User
{
    protected int $id;
    protected string $first_name;
    protected string $last_name;
    protected string $email;
    protected string $created_date;
    public function __construct($id, $first_name, $last_name, $email,$created_date)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->created_date = $created_date;
    }
    public function get_id()
    {
        return $this->id;
    }
    public function get_first_name()
    {
        return $this->first_name;
    }
    public function get_last_name()
    {
        return $this->last_name;
    }
    public function get_email()
    {
        return $this->email;
    }
    public function get_created_date(){
        return $this->created_date;
    }
}
