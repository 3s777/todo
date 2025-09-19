<?php

namespace App\Http\Actions\Api\V1;

use App\DTOs\Api\V1\StoreTaskDTO;
use App\Models\Task;

class StoreTaskAction
{
    public function __invoke(StoreTaskDTO $data): Task
    {
        return Task::create([
            'title' => $data->title,
            'description' => $data->description,
            'status' => $data->status,
        ]);
    }
}
