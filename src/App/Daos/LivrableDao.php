<?php

namespace App\Daos;

use App\Core\DataBase;

class LivrableDao
{
    private $data;
    private static $instance;
    public function __construct()
    {
        $this->data = DataBase::get_instance();
    }
    public static function get_instance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function insert_livrable($url, $comment, $student_id, $brief_id)
    {
        $query = 'INSERT into livrable (url,comment,student_id,brief_id) 
                    values(:url,:comment,:student_id,:brief_id)';
        $params = [
            ':url' => $url,
            ':comment' => $comment,
            ':student_id' => $student_id,
            ':brief_id' => $brief_id
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }

    public function update_livrable($id,$url, $comment, $student_id, $brief_id)
    {
        $query = 'UPDATE livrable 
                    set url=:url,
                    comment=:comment,
                    student_id=:student_id,
                    brief_id=:brief_id 
                    where id=:id';
        $params = [
            ':url' => $url,
            ':comment' => $comment,
            ':student_id' => $student_id,
            ':brief_id' => $brief_id,
            ':id'=>$id
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }
}
