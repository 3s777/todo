<?php

namespace Api\V1\Actions;

use App\DTOs\Api\V1\UpdateTaskDTO;
use App\Enums\StatusEnum;
use App\Http\Actions\Api\V1\UpdateTaskAction;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTaskActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_created_success(): void
    {
        $request = [
            'title' => 'New Title',
            'status' => StatusEnum::Work->value,
            'description' => 'Some new description',
        ];

        $task = Task::factory()->create([
            'title' => 'Old Title',
            'status' => StatusEnum::New->value,
            'description' => 'Some old description',
        ]
        );

        $this->assertDatabaseHas('tasks', [
            'title' => $task->title,
        ]);

        $action = app(UpdateTaskAction::class);

        $action(UpdateTaskDTO::make(
            $request['title'],
            $request['status'],
            $request['description'],
        ), $task);

        $this->assertDatabaseHas('tasks', [
            'title' => $request['title'],
        ]);
    }
}
