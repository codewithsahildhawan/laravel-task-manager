<?php

namespace App\DTOs;
use App\Http\Requests\StoreTaskRequest;

class TaskData
{
    public string $title;
    public ?string $description;
    /**
     * Create a new class instance.
     */
    public function __construct(
        array $data
    ) {
        $this->title = $data['title'];
        $this->description = $data['description'] ?? null;
    }

    public static function fromRequest(StoreTaskRequest $request): self
    {
        return new self($request->validated());
    }
}
