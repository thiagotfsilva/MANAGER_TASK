<?php

namespace App\Domain\User\Entity;

class User
{

    private ?int $id;
    private string $name;
    private string $email;
    private string $password;

    public function __construct(
        ?int $id,
        string $name,
        string $email,
        string $password
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }



    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
        ];
    }

}
