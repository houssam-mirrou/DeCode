<?php

namespace App\Dtos;

class StudentEvaluationTeacherDTO
{
    public function __construct(
        // Student (users)
        public int $studentId,
        public string $fullName,
        public string $email,

        // Brief (brief)
        public int $briefId,
        public string $briefTitle,
        public string $briefDescription,

        // Livrable (livrable) - Nullable if not submitted
        public ?string $repoLink,
        public ?string $dateSubmitted,
        public ?string $studentComment,

        // Evaluation (evaluation) - Nullable if not graded yet
        public ?int $evaluationId,
        public ?string $teacherComment,
        public ?string $reviewStatus, // 'bad', 'good', 'excellent'

        // List of CompetenceGradeDTO
        /** @var CompetenceGradeDTO[] */
        public array $competences = []
    ) {}

    public static function fromDatabase(array $ctx, array $compRows): self
    {
        // Map Competences
        $competencesList = [];
        foreach ($compRows as $row) {
            $competencesList[] = new CompetenceGradeDTO(
                $row['competence_id'],
                $row['code'],
                $row['libelle'], // Strictly matching DB column
                $row['target_level'],
                $row['acquired_level'] ?? null
            );
        }

        return new self(
            $ctx['student_id'],
            $ctx['first_name'] . ' ' . $ctx['last_name'],
            $ctx['email'],
            $ctx['brief_id'],
            $ctx['title'],
            $ctx['description'],
            $ctx['url'] ?? null,            // livrable.url
            $ctx['date_submitted'] ?? null, // livrable.date_submitted
            $ctx['student_comment'] ?? null,// livrable.comment
            $ctx['evaluation_id'] ?? null,  // evaluation.id
            $ctx['teacher_comment'] ?? null,// evaluation.comment
            $ctx['review'] ?? null,         // evaluation.review
            $competencesList
        );
    }
}