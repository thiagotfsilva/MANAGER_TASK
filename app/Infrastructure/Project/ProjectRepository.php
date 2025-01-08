<?php

namespace App\Infrastructure\Project;

use App\Domain\Project\Entity\Project;
use App\Domain\Project\Repository\ProjectRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function createProject(array $data): Project
    {
        $taskId = DB::table('projects')->insertGetId([
            'title' => $data['title'],
            'description' => $data['description'],
            'creator_id' => $data['creator_id'],
        ]);

        return $this->findProject($taskId);
    }

    public function findProject(int $id): Project
    {
        $task = DB::table('projects')->where('id', $id)->first();
        return new Project(
            $task->id,
            $task->title,
            $task->description,
            $task->creator_id,
        );
    }

    public function updateProject(array $data): Project
    {
        DB::table('projects')
            ->where('id', $data['id'])
            ->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'creator_id' => $data['creator_id'],
            ]);

        return $this->findProject($data['id']);
    }

    public function deleteProject(int $id): void
    {
        DB::table('projects')
            ->where('id', $id)
            ->delete();
    }
}
