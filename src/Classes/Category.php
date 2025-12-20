<?php

declare(strict_types=1);

namespace APP\Classes;

final class Category extends AbstractClass
{
    private int $id;
    private string $name;
    private bool $isActive;

    public function __construct(int $id, string $name, bool $isActive = true)
    {
        $this->id = $id;
        $this->name = $name;
        $this->isActive = $isActive;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? 0,
            $data['name'] ?? '',
            $data['isActive'] ?? true
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'isActive' => $this->isActive,
        ];
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
