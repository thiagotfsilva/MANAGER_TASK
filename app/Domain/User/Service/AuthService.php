<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function register(array $data): User
    {
        return $this->userRepository->register([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
