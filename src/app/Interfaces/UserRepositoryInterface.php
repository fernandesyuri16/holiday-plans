<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function createUser(array $userDetails);
    public function getUserById(int $userId);
    public function getUserByEmail(string $userEmail);
    public function updateUser(int $userId, array $userDetails);
    public function deleteUser(int $userId);
}
