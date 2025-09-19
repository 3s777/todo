<?php

namespace Api\V1\DTOs;

use App\DTOs\Api\V1\UpdateTaskDTO;
use App\Enums\StatusEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class UpdateTaskDTOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = [
            'title' => 'Some Title',
            'status' => StatusEnum::Work->value,
            'description' => 'Some Description',
        ];
    }

    public function test_instance_created_from_request_success(): void
    {
        $data = UpdateTaskDTO::fromRequest(new Request($this->request));

        $this->assertInstanceOf(UpdateTaskDTO::class, $data);
    }

    public function test_instance_created_success(): void
    {

        $data = UpdateTaskDTO::make(
            $this->request['title'],
            $this->request['status'],
            $this->request['description'],
        );

        $this->assertInstanceOf(UpdateTaskDTO::class, $data);
    }

    public function test_to_array_success(): void
    {
        $dto = UpdateTaskDTO::make(
            $this->request['title'],
            $this->request['status'],
            $this->request['description'],
        );

        $data = $dto->toArray();

        $this->assertSame(
            [
                'title' => $this->request['title'],
                'status' => $this->request['status'],
                'description' => $this->request['description'],
            ],
            $data);
    }
}
