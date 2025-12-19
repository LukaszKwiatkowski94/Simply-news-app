<?php

declare(strict_types=1);

namespace APP\Classes;

/**
 * Represents user data.
 */
final class UserData extends AbstractClass
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $username,
        public readonly ?string $name,
        public readonly ?string $surname
    ) {}

    /**
     * Creates a UserData instance from an associative array.
     * @param array $data The associative array containing user data.
     * @return UserData The created UserData instance.
     */
    public function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['username'] ?? null,
            $data['name'] ?? null,
            $data['surname'] ?? null
        );
    }

    /**
     * Converts the UserData instance to an associative array.
     * @return array The associative array representation of the user data.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'name' => $this->name,
            'surname' => $this->surname,
        ];
    }

    /**
     * Converts the UserData instance to a JSON string.
     *
     * @return string The JSON representation of the user data.
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
