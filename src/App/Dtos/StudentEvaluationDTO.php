<?php
namespace App\Dtos;

use App\Models\Student;
use App\Models\Livrable;

class StudentEvaluationDTO
{
    public Student $student;
    public ?Livrable $livrable = null;
    public ?string $review_status = null;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }
}
