<?php

namespace App\Infrastructure\User;


use App\Domain\User\Repository\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function register(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        return $user;
    }

    public function findUserById(int $id): User
    {
        $user = DB::table('users')->where('id', $id)->first();
        return new User(
            $user->id,
            $user->name,
            $user->email,
            $user->password,
        );
    }

    public function findUserByEmail(int $email): User
    {
        $user = DB::table('users')->where('email', $email)->first();
        return new User(
            $user->id,
            $user->name,
            $user->email,
            $user->password,
        );
    }
}
