<?php

namespace Api\V1\Actions;

use App\DTOs\Api\V1\StoreTaskDTO;
use App\Enums\StatusEnum;
use App\Http\Actions\Api\V1\StoreTaskAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTaskActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_created_success(): void
    {
        $request = [
            'title' => 'Title',
            'status' => StatusEnum::Work->value,
            'description' => 'Some description',
        ];

        $this->assertDatabaseMissing('tasks', [
            'title' => $request['title'],
        ]);

        $action = app(StoreTaskAction::class);

        $action(StoreTaskDTO::make(
            $request['title'],
            $request['status'],
            $request['description']
        ));

        $this->assertDatabaseHas('tasks', [
            'title' => $request['title'],
        ]);
    }
}
