<?php

namespace App\Domain\TasK\Repository;

use App\Domain\TasK\Entity\Task;

interface TaskRepositoryInterface
{
    public function createTask(array $data): Task;
    public function findTask(int $id): Task;
    public function updateTask(array $data): Task;
    public function deleteTask(int $id): int;
}
