<?php

namespace App\Domain\TasK\Entity;

use App\Enum\TaskStatus;
use DateTime;

class Task
{
    private ?int $id;
    private string $title;
    private ?string $description;
    private TaskStatus $status;
    private DateTime $created_at;
    private ?DateTime $completed_at;

    public function __construct(
        ?int $id,
        string $title,
        ?string $description,
        TaskStatus $status = TaskStatus::PENDING,
        ?DateTime $created_at = null,
        ?DateTime $completed_at = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->completed_at = $completed_at;
        $this->created_at = $created_at ?? new DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescritption(): ?string
    {
        return $this->description;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function getCompletAt(): ?DateTime
    {
        return $this->completed_at;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'description' => $this->getDescritption(),
            'status' => $this->getStatus(),
            'created_at' => $this->getCreatedAt()->format('Y-m-d H:i:s'),
            'completed_at' => $this->getCompletAt()?->format('Y-m-d H:i:s'),
        ];
    }
}
