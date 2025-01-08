<?php

namespace App\Domain\Project\Repository;

use App\Domain\Project\Entity\Project;

interface ProjectRepositoryInterface
{
    public function createProject(array $data): Project;
    public function findProject(int $id): Project;
    public function updateProject(array $data): Project;
    public function deleteProject(int $id): void;
}
