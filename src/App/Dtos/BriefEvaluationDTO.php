<?php

namespace App\Dtos;

use App\Models\Brief;
use App\Models\Livrable;
use App\Models\Student;

class BriefEvaluationDTO
{
    public Brief $brief;
    /** @var StudentEvaluationDTO[] */
    public array $students = [];

    public function __construct(Brief $brief)
    {
        $this->brief = $brief;
    }
}
