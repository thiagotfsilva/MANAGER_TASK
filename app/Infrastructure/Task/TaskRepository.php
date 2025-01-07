<?php

namespace App\Infrastructure\Task;

use App\Domain\TasK\Entity\Task;
use App\Domain\TasK\Repository\TaskRepositoryInterface;
use App\Enum\TaskStatus;
use Illuminate\Support\Facades\DB;

class TaskRepository implements TaskRepositoryInterface
{
    public function createTask(array $data): Task
    {
        $taskId = DB::table('tasks')->insertGetId([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'created_at' => $data['created_at']
        ]);

        return $this->findTask($taskId);
    }

    public function findTask(int $id): Task
    {
        $task = DB::table('tasks')->where('id', $id)->first();
        return new Task(
            $task->id,
            $task->title,
            $task->description,
            TaskStatus::from($task->status),
        );
    }

    public function updateTask(array $data): Task
    {
        DB::table('tasks')
            ->where('id', $data['id'])
            ->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'status' => $data['status'],
                'completed_at' => $data['completed_at'],
            ]);

        return $this->findTask($data['id']);
    }

    public function deleteTask(int $id): int
    {
        return DB::table('tasks')
            ->where('id', $id)
            ->delete();
    }
}
