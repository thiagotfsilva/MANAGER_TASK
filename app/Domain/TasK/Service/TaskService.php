<?php

namespace App\Domain\TasK\Service;

use App\Domain\TasK\Entity\Task;
use App\Domain\TasK\Repository\TaskRepositoryInterface;
use InvalidArgumentException;

class TaskService
{
    public function __construct(private TaskRepositoryInterface $taskRepository) {}

    public function createTask(Task $task): Task
    {
        return $this->taskRepository->createTask([
            'title' => $task->getTitle(),
            'description' => $task->getDescritption(),
            'status' => $task->getStatus(),
            'created_at' => $task->getCreatedAt(),
        ]);
    }

    public function findTask(int $id)
    {
        $this->validateId($id);
        return $this->taskRepository->findTask($id);
    }

    public function updateTask(Task $task): Task
    {
        $this->validateId($task->getId());
        return $this->taskRepository->updateTask([
            'id' => $task->getId(),
            'title' => $task->getTitle(),
            'description' => $task->getDescritption(),
            'status' => $task->getStatus(),
            'completed_at' => $task->getCompletAt(),
        ]);
    }

    public function deleteTask(int $id): void
    {
        $this->validateId($id);
        $this->taskRepository->deleteTask($id);
    }

    private function validateId(int $id): void
    {
        if ($id <= 0) {
            throw new InvalidArgumentException('Invalid Id.');
        }
    }

}
