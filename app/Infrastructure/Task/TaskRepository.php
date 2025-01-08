<?php

namespace App\Infrastructure\Task;

use App\Domain\Task\Entity\Task;
use App\Domain\Task\Repository\TaskRepositoryInterface;
use App\Enum\TaskStatus;
use DateTime;
use Illuminate\Support\Facades\DB;

class TaskRepository implements TaskRepositoryInterface
{
    public function createTask(array $data): Task
    {
        $taskId = DB::table('tasks')->insertGetId([
            'title' => $data['title'],
            'description' => $data['description'],
            'creator_id' => $data['creator_id'],
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
            $task->creator_id,
            TaskStatus::from($task->status),
            new DateTime($task->created_at),
        );
    }

    public function updateTask(array $data): Task
    {
        DB::table('tasks')
            ->where('id', $data['id'])
            ->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'creator_id' => $data['creator_id'],
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
