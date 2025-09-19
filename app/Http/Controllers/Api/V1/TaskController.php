<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\Api\V1\StoreTaskDTO;
use App\DTOs\Api\V1\UpdateTaskDTO;
use App\Http\Actions\Api\V1\StoreTaskAction;
use App\Http\Actions\Api\V1\UpdateTaskAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreTaskRequest;
use App\Http\Requests\Api\V1\UpdateTaskRequest;
use App\Http\Resources\Api\V1\TaskResource;
use App\Http\Resources\Api\V1\TaskResourceCollection;
use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index(): TaskResourceCollection
    {
        $tasks = Task::orderBy('id', 'asc')->paginate(10);

        return new TaskResourceCollection($tasks);
    }

    public function store(StoreTaskRequest $request, StoreTaskAction $action): TaskResource
    {
        $task = $action(StoreTaskDTO::fromRequest($request));

        return new TaskResource($task);
    }

    public function show(Task $task): JsonResource
    {
        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, Task $task, UpdateTaskAction $action): TaskResource
    {
        $task = $action(UpdateTaskDTO::fromRequest($request), $task);

        return new TaskResource($task);
    }

    public function destroy(Task $task): Response
    {
        $task->delete();

        return response()->noContent();
    }
}
