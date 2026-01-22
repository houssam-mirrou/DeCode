<?php

namespace App\Dtos;

class StudentRosterDTO
{
    public function __construct(
        public int $id,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $joinedDate,
        // Stats
        public int $validatedBriefs, // Count of 'good'/'excellent' reviews
        public int $totalBriefs      // Total briefs assigned to their class (approx)
    ) {}

    public function getInitials(): string
    {
        return substr($this->firstName, 0, 1) . substr($this->lastName, 0, 1);
    }
}