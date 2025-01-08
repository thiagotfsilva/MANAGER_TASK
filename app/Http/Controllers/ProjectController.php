<?php

namespace App\Http\Controllers;

use App\Domain\Project\Entity\Project;
use App\Domain\Project\Service\ProjectService;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(private ProjectService $projectService) {
        $this->middleware('auth:api');
    }

    public function store(StoreProjectRequest $request)
    {
        try {
            $validated = $request->validated();
            $user = auth()->user();

            $projectDTO = new Project(
                $validated['id'] ?? null,
                $validated['title'],
                $validated['description'] ?? null,
                $user->id
            );
            $project = $this->projectService->createProject($projectDTO);
            return response()->json($project->toArray(), JsonResponse::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateProjectRequest $request, int $id)
    {
        $existingTask = $this->projectService->findProject($id);

        if (!$existingTask) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validated = $request->validated();



        $user = auth()->user();

        $projectDTO = new Project(
            $id,
            $validated['title'] ?? $existingTask->getTitle(),
            $validated['description'] ?? $existingTask->getDescritption(),
            $user->id,
        );

        $task = $this->projectService->updateProject($projectDTO);

        return response()->json($task->toArray());
    }

    public function show(Request $request, int $id)
    {
        $project = $this->projectService->findProject($id);
        return response()->json($project->toArray());
    }

    public function destroy(Request $request, int $id)
    {
        $this->projectService->deleteProject($id);
        return response()->json([], 204);
    }

}
