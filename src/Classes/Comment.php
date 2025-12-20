<?php

declare(strict_types=1);

namespace APP\Classes;

final class Comment extends AbstractClass
{
    private int $id;
    private int $newsId;
    private int $authorId;
    private string $content;
    private string $createdAt;

    public function __construct(int $id, int $newsId, int $authorId, string $content, string $createdAt)
    {
        $this->id = $id;
        $this->newsId = $newsId;
        $this->authorId = $authorId;
        $this->content = $content;
        $this->createdAt = $createdAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNewsId(): int
    {
        return $this->newsId;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? 0,
            $data['newsId'] ?? 0,
            $data['authorId'] ?? 0,
            $data['content'] ?? '',
            $data['createdAt'] ?? ''
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'authorId' => $this->authorId,
            'newsId' => $this->newsId,
            'content' => $this->content,
            'createdAt' => $this->createdAt,
        ];
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
