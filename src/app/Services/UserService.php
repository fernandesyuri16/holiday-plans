<?php

namespace App\Services;

use App\Helpers\Http;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use Http;

    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository;
    }

    public function createUser(array $userDetails): array
    {
        $userDetails['password'] = Hash::make($userDetails['password']);

        $user = $this->repository->createUser($userDetails);

        return $this->created($user);
    }

    public function getUser(int $userId): array
    {
        $error = $this->checkIfHasError($userId);

        if (! empty($error)) {
            return $error;
        }

        $user = $this->repository->getUserById($userId);

        return $this->ok($user);
    }

    public function getUsers(): array
    {
        $users = $this->repository->getUsers();

        return $this->ok($users->items());
    }

    private function checkIfHasError(int $userId, bool $checkPermission = false): array
    {
        if (! $this->userExists($userId)) {
            return $this->notFound("User doesn't exists.");
        }

        if ($checkPermission && $userId !== auth()->user()->id) {
            return $this->forbidden("You don't have permission to update or delete this user.");
        }

        return [];
    }

    private function userExists(int $userId): bool
    {
        $user = $this->repository->getUserById($userId);

        if (empty($user->id)) {
            return false;
        }

        return true;
    }

    public function updateUser(int $userId, array $userDetails): array
    {
        $error = $this->checkIfHasError($userId, true);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->updateUser($userId, $userDetails);

        $user = $this->repository->getUserById($userId);

        return $this->ok($user);
    }

    public function deleteUser(int $userId): array
    {
        $error = $this->checkIfHasError($userId, true);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->deleteUser($userId);

        return $this->ok('User successfully deleted!');
    }
}
