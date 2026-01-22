<?php

namespace App\Daos;

use App\Core\DataBase;

class SprintDao
{
    private $data;
    private static $instance;

    private function __construct()
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
    public function insert_sprint($name, $start_date, $end_date, $class_id)
    {
        $query = 'INSERT into sprint (name,start_date,end_date,class_id)
                    values (:name,:start_date,:end_date,:class_id)';
        $params = [
            ':name' => $name,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            ':class_id' => $class_id
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }
    public function update_sprint($id, $name, $start_date, $end_date, $class_id)
    {
        $query = 'UPDATE sprint set name=:name,start_date=:start_date,end_date=:end_date ,class_id=:class_id where id=:id';
        $params = [
            ':name' => $name,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            ':id' => $id,
            ':class_id' => $class_id
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }
    public function delete_sprint($id)
    {
        $query = 'DELETE from sprint where id=:id';
        $params = [
            ':id' => $id
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }

    public function get_all_sprints()
    {
        $query = 'SELECT * from sprint ;';
        $result = $this->data->query($query);
        return $result;
    }

    public function get_all_sprints_with_briefs_and_competences()
    {
        $query = 'SELECT 
                s.id AS sprint_id,
                s.name ,
                s.start_date,
                s.end_date,
                s.class_id,

                b.id AS brief_id,
                b.title,
                b.description,
                b.date_remise,
                b.type,

                c.id AS competence_id,
                c.code,
                c.libelle,
                c.description AS competence_description,
                bc.level AS competence_level

            FROM sprint s
            JOIN brief b ON b.sprint_id = s.id
            JOIN brief_competence bc ON bc.brief_id = b.id
            JOIN competence c ON c.id = bc.competence_id
        ';
        $result = $this->data->query($query);
        return $result;
    }

    public function get_all_sprints_with_briefs_and_competences_and_submission($studentId)
    {
        $query = "SELECT 
            s.id AS sprint_id,
            s.name,
            s.start_date,
            s.end_date,
            s.class_id,

            b.id AS brief_id,
            b.title,
            b.description,
            b.date_remise,
            b.type,

            c.id AS competence_id,
            c.code,
            c.libelle,
            c.description AS competence_description,

            bc.level AS competence_level,

            l.id AS livrable_id,
            l.url AS repo_link,
            l.comment AS livrable_comment,
            l.date_submitted,

            e.review AS review_status

        FROM sprint s
        JOIN brief b ON b.sprint_id = s.id
        JOIN brief_competence bc ON bc.brief_id = b.id
        JOIN competence c ON c.id = bc.competence_id

        LEFT JOIN livrable l
            ON l.brief_id = b.id AND l.student_id = :studentId

        LEFT JOIN evaluation e
            ON e.brief_id = b.id AND e.student_id = :studentId

        ORDER BY s.start_date DESC, b.date_remise ASC
    ";

        return $this->data->query($query, [':studentId' => $studentId]);
    }

    public function get_sprint_by_id($id)
    {
        $query = 'SELECT * from sprint where id=:id';
        $params = [
            ':id' => $id
        ];
        $result = $this->data->query($query, $params);
        return $result[0];
    }

    public function get_all_briefs_submitted_by_students($class_id)
    {
        $query = "SELECT 
                -- Sprint
                s.id AS sprint_id, s.name AS sprint_name, s.start_date, s.end_date, s.class_id,
                
                -- Brief
                b.id AS brief_id, b.title, b.description, b.date_remise, b.type,
                
                -- Student (User)
                u.id AS user_id, u.first_name, u.last_name, u.email, u.role, u.created_date,
                
                -- Submission (Livrable)
                l.id AS livrable_id, l.url AS repo_link, l.comment AS livrable_comment, l.date_submitted,
                
                -- Evaluation
                e.review AS review_status

            FROM sprint s
            JOIN brief b ON b.sprint_id = s.id
            -- Get all students in the class associated with the sprint
            JOIN users u ON u.class_id = s.class_id
            -- Attach submissions if they exist
            LEFT JOIN livrable l ON l.student_id = u.id AND l.brief_id = b.id
            -- Attach evaluations if they exist
            LEFT JOIN evaluation e ON e.student_id = u.id AND e.brief_id = b.id
            
            WHERE s.class_id = :class_id AND u.role = 'student'
            ORDER BY s.id DESC, b.id ASC, u.last_name ASC
        ";

        return $this->data->query($query, [':class_id' => $class_id]);
    }

    public function get_student_evaluation_data($brief_id, $student_id)
    {
        // 1. Context Query: Users, Brief, Livrable, Evaluation
        $queryContext = "SELECT 
                u.id as student_id, u.first_name, u.last_name, u.email,
                b.id as brief_id, b.title, b.description,
                l.url, l.date_submitted, l.comment as student_comment,
                e.id as evaluation_id, e.comment as teacher_comment, e.review
            FROM users u
            JOIN brief b ON b.id = :brief_id
            -- Left Join Livrable: We want the student even if they didn't submit
            LEFT JOIN livrable l ON l.student_id = u.id AND l.brief_id = b.id
            -- Left Join Evaluation: We want data even if not graded yet
            LEFT JOIN evaluation e ON e.student_id = u.id AND e.brief_id = b.id
            WHERE u.id = :student_id
        ";

        // 2. Competence Query: Brief_Competence -> Competence -> Evaluation_Competences
        $queryComp = "SELECT 
                c.id as competence_id, c.code, c.libelle,
                bc.level as target_level,
                ec.level as acquired_level
            FROM brief_competence bc
            JOIN competence c ON bc.competence_id = c.id
            
            -- Find existing grade for this specific student
            LEFT JOIN evaluation e ON e.brief_id = bc.brief_id AND e.student_id = :student_id
            LEFT JOIN evaluation_competences ec ON ec.evaluation_id = e.id AND ec.competence_id = c.id
            
            WHERE bc.brief_id = :brief_id
        ";

        $context = $this->data->query($queryContext, [':brief_id' => $brief_id, ':student_id' => $student_id]);
        $competences = $this->data->query($queryComp, [':brief_id' => $brief_id, ':student_id' => $student_id]);

        return [
            'context' => $context[0] ?? null,
            'competences' => $competences
        ];
    }
}
