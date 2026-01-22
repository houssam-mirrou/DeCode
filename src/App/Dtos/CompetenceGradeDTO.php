<?php

namespace App\DTOs;

class CompetenceGradeDTO
{
    public int $id;
    public string $code;
    public string $libelle;
    public string $targetLevel;
    public ?string $acquiredLevel;
    public function __construct($id, $code, $libelle, $targetLevel, $acquiredLevel)
    {
        $this->id = $id;
        $this->code = $code;
        $this->libelle = $libelle;
        $this->targetLevel = $targetLevel;
        $this->acquiredLevel = $acquiredLevel;
    }

    
}
