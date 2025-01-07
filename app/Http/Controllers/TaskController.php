<?php

namespace App\Http\Controllers;

use App\Domain\TasK\Entity\Task as EntityTask;
use App\Domain\TasK\Service\TaskService;
use App\Enum\TaskStatus;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Models\Task;
use DateTime;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class TaskController extends Controller
{

    public function __construct(private TaskService $taskService) {}

    public function store(StoreTaskRequest $request)
    {
        try {
            $validated = $request->validated();
            $taskDTO = new EntityTask(
                $validated['id'] ?? null,
                $validated['title'],
                $validated['description'] ?? null,
            );
            $task = $this->taskService->createTask($taskDTO);
            return response()->json($task->toArray(), JsonResponse::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Request $request, int $id)
    {
        $task = $this->taskService->findTask($id);
        return response()->json($task->toArray());
    }

    public function index(Request $request)
    {
        return new TaskCollection(Task::all());
    }

    public function update(UpdateTaskRequest $request, int $id)
    {
        $existingTask = $this->taskService->findTask($id);

        if (!$existingTask) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validated = $request->validated();

        $status = isset($validated['status'])
        ? TaskStatus::from($validated['status'])
        : $existingTask->getStatus();

        $taskDTO = new EntityTask(
            $id,
            $validated['title'] ?? $existingTask->getTitle(),
            $validated['description'] ?? $existingTask->getDescritption(),
            $status,
            $existingTask->getCreatedAt(),
            isset($validated['completed_at']) ? new DateTime($validated['completed_at']) : $existingTask->getCompletAt()
        );

        $task = $this->taskService->updateTask($taskDTO);

        return response()->json($task->toArray());
    }

    public function destroy(Request $request, int $id)
    {
        $this->taskService->deleteTask($id);
        return response()->json([], 204);
    }

}
