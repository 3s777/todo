<?php

namespace Api\V1\Controllers;

use App\Enums\StatusEnum;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Task::factory(10)->create();
    }

    public function test_successful_index(): void
    {
        $response = $this->getJson(route('api.v1.tasks.index'));

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'type',
                        'id',
                        'attributes' => [
                            'title',
                            'description',
                            'status',
                            'created_at',
                        ],
                    ],
                ],
                'links',
                'meta',
            ])
            ->assertJsonCount(10, 'data');
    }

    public function test_successful_show(): void
    {
        $task = Task::first();

        $response = $this->getJson(route('api.v1.tasks.show', ['task' => $task->id]));

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'type',
                    'id',
                    'attributes' => [
                        'title',
                        'description',
                        'status',
                        'created_at',
                    ],
                ],
            ]);
    }

    public function test_returns404_for_nonexistent(): void
    {
        $response = $this->getJson(route('api.v1.tasks.show', ['task' => 99999]));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_store_success(): void
    {
        $storeData = [
            'title' => 'New Title',
            'description' => 'New Description',
            'status' => StatusEnum::Work->value,
        ];

        $response = $this->postJson(route('api.v1.tasks.store'), $storeData);

        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'type',
                    'id',
                    'attributes' => [
                        'title',
                        'description',
                        'status',
                        'created_at',
                    ],
                ],
            ]);

        $this->assertDatabaseHas('tasks', ['title' => 'New Title']);
    }

    public function test_update_success(): void
    {
        $task = Task::factory()->create([
            'title' => 'Old Title',
            'description' => 'Old Description',
            'status' => StatusEnum::New->value,
        ]
        );

        $updateData = [
            'title' => 'New Title',
            'description' => 'New Description',
            'status' => StatusEnum::Work->value,
        ];

        $response = $this->putJson(route('api.v1.tasks.update', ['task' => $task->id]), $updateData);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'type',
                    'id',
                    'attributes' => [
                        'title',
                        'description',
                        'status',
                        'created_at',
                    ],
                ],
            ]);

        $this->assertDatabaseHas('tasks', ['title' => 'New Title']);
    }

    public function test_delete_success(): void
    {
        $task = Task::factory()->create([
            'title' => 'Old Title',
        ]);

        $response = $this->deleteJson(route('api.v1.tasks.destroy', ['task' => $task->id]));

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('tasks', ['title' => $task->title]);
    }

    public function test_validation_fail(): void
    {
        $request['status'] = 'wrong';

        $this->postJson(route('api.v1.tasks.store'), $request)
            ->assertInvalid(['title', 'status']);
    }
}
