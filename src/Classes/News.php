<?php

declare(strict_types=1);

namespace APP\Classes;

final class News extends AbstractClass
{
    private int $id;
    private string $title;
    private string $content;
    private int $authorId;
    private string $dateCreated;
    private bool $active;
    private ?string $dateLastUpdated;
    private string $authorName;
    private string $categoryName;

    public function __construct(int $id, string $title, string $content, int $authorId, string $dateCreated, bool $active, ?string $dateLastUpdated = '', string $authorName = '', string $categoryName = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->authorId = $authorId;
        $this->dateLastUpdated = $dateLastUpdated;
        $this->dateCreated = $dateCreated;
        $this->active = $active;
        $this->authorName = $authorName;
        $this->categoryName = $categoryName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function getDateCreated(): string
    {
        return $this->dateCreated;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    public function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? 0,
            $data['title'] ?? '',
            $data['content'] ?? '',
            $data['authorId'] ?? 0,
            $data['dateCreated'] ?? '',
            $data['dateLastUpdated'] ?? '',
            $data['active'] ?? false,
            $data['authorName'] ?? '',
            $data['categoryName'] ?? ''
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'authorId' => $this->authorId,
            'dateCreated' => $this->dateCreated,
            'dateLastUpdated' => $this->dateLastUpdated,
            'active' => $this->active,
            'authorName' => $this->authorName,
            'categoryName' => $this->categoryName
        ];
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
