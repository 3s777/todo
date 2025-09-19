<?php

namespace Api\V1\DTOs;

use App\DTOs\Api\V1\StoreTaskDTO;
use App\Enums\StatusEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class StoreTaskDTOTest extends TestCase
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
        $data = StoreTaskDTO::fromRequest(new Request($this->request));

        $this->assertInstanceOf(StoreTaskDTO::class, $data);
    }

    public function test_instance_created_success(): void
    {

        $data = StoreTaskDTO::make(
            $this->request['title'],
            $this->request['status'],
            $this->request['description'],
        );

        $this->assertInstanceOf(StoreTaskDTO::class, $data);
    }
}
