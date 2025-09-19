<?php

namespace App\DTOs\Api\V1;

use App\Support\Traits\Makeable;
use Illuminate\Http\Request;

final readonly class StoreTaskDTO
{
    use Makeable;

    public function __construct(
        public string $title,
        public string $status,
        public ?string $description = null,
    ) {}

    public static function fromRequest(Request $request): StoreTaskDTO
    {
        return self::make(...$request->only([
            'title',
            'status',
            'description',
        ]));
    }
}
