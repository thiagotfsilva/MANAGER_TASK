<?php

namespace App\Domain\Project\Entity;

class Project
{
    private ?int $id;
    private string $title;
    private ?string $description;
    private int $creator_id;

    public function __construct(
        ?int $id,
        string $title,
        ?string $description,
        int $creator_id,
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->creator_id =  $creator_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreatorId(): int
    {
        return $this->creator_id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescritption(): ?string
    {
        return $this->description;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'description' => $this->getDescritption(),
            'creator_id' => $this->getCreatorId(),
        ];
    }
}
