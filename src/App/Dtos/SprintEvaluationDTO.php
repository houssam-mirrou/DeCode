<?php

namespace App\Dtos;

use App\Models\Sprint;

class SprintEvaluationDTO {
    public Sprint $sprint;
    /** @var BriefEvaluationDTO[] */
    public array $briefs = [];

    public function __construct(Sprint $sprint)
    {
        $this->sprint = $sprint;
    }

}