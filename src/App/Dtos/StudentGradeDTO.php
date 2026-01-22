<?php

namespace App\Dtos;


class StudentGradeDTO {
    public function __construct(
        public string $briefTitle,
        public string $gradedDate,
        public string $status, // 'good', 'excellent', 'bad'
        public ?string $teacherComment,
        public array $skills = [] // Array of ['name' => string, 'level' => string]
    ) {}
    
    // Helper for badge colors
    public function getStatusColor(): string {
        return match($this->status) {
            'excellent' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
            'good'      => 'bg-emerald-100 text-emerald-700 border-emerald-200',
            'bad'       => 'bg-red-100 text-red-700 border-red-200',
            default     => 'bg-slate-100 text-slate-600'
        };
    }
}