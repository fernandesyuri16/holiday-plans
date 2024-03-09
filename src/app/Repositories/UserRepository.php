<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(array $userDetails): User
    {
        return User::create($userDetails);
    }

    public function getUserById(int $userId): ?User
    {
        return User::find($userId);
    }

    public function getUserByEmail(string $userEmail): ?User
    {
        return User::where('email', $userEmail)->first();
    }

    public function updateUser(int $userId, array $userDetails): void
    {
        User::whereId($userId)->update($userDetails);
    }

    public function deleteUser(int $userId): void
    {
        User::destroy($userId);
    }
}
