<?php

namespace App\DTOs\Api\V1;

use App\Support\Traits\Makeable;
use Illuminate\Http\Request;

final readonly class UpdateTaskDTO
{
    use Makeable;

    public function __construct(
        public ?string $title = null,
        public ?string $status = null,
        public ?string $description = null,
    ) {}

    public static function fromRequest(Request $request): UpdateTaskDTO
    {
        return self::make(...$request->only([
            'title',
            'status',
            'description',
        ]));
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'status' => $this->status,
            'description' => $this->description,
        ];
    }
}
