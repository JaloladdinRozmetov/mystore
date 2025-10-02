<?php

namespace App\DTOs;

use App\Http\Requests\ContactRequest;

class ContactData
{
    public function __construct(
        public string $name,
        public string $phone,
        public ?string $description,
        public ?int $user_id,
    ) {}

    public static function fromRequest(ContactRequest $request): self
    {
        return new self(
            name:        $request->string('name')->toString(),
            phone:       $request->string('phone')->toString(),
            description: $request->filled('description') ? $request->string('description')->toString() : null,
            user_id:     $request->user()?->id
        );
    }

    public function toArray(): array
    {
        return [
            'name'        => $this->name,
            'phone'       => $this->phone,
            'description' => $this->description,
            'user_id'     => $this->user_id,
        ];
    }
}
