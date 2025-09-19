<?php

namespace App\Http\Actions\Api\V1;

use App\DTOs\Api\V1\UpdateTaskDTO;
use App\Models\Task;

class UpdateTaskAction
{
    public function __invoke(UpdateTaskDTO $dto, Task $task): Task
    {
        $data = $dto->toArray();
        $task->fill($data)->save();

        return $task;
    }
}
