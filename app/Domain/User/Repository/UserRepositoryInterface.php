<?php

namespace App\Domain\User\Repository;

use App\Models\User;

interface UserRepositoryInterface
{
    public function register(array $data): User;
    public function findUserById(int $id): User;
    public function findUserByEmail(int $email): User;
}
