<?php

namespace App\Domain\Project\Service;

use App\Domain\Project\Entity\Project;
use App\Domain\Project\Repository\ProjectRepositoryInterface;
use InvalidArgumentException;

class ProjectService
{
    public function __construct(private ProjectRepositoryInterface $projectRepository) {}

    public function createProject(Project $project): Project
    {
        return $this->projectRepository->createProject([
            'title' => $project->getTitle(),
            'description' => $project->getDescritption(),
            'creator_id' => $project->getCreatorId(),
        ]);
    }

    public function findProject(int $id)
    {
        $this->validateId($id);
        return $this->projectRepository->findProject($id);
    }

    public function updateProject(Project $project): Project
    {
        $this->validateId($project->getCreatorId());
        return $this->projectRepository->updateProject([
            'id' => $project->getId(),
            'title' => $project->getTitle(),
            'description' => $project->getDescritption(),
            'creator_id' => $project->getCreatorId(),
        ]);
    }

    public function deleteProject(int $id): void
    {
        $this->validateId($id);
        $this->projectRepository->deleteProject($id);
    }

    private function validateId(int $id): void
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid Id.');
        }
    }
}
