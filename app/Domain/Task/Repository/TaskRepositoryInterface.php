<?php

namespace App\Domain\Task\Repository;

use App\Domain\Task\Entity\Task;

interface TaskRepositoryInterface
{
    public function createTask(array $data): Task;
    public function findTask(int $id): Task;
    public function updateTask(array $data): Task;
    public function deleteTask(int $id): int;
}
