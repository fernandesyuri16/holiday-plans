<?php

namespace App\Http\Controllers;

use App\Helpers\Http;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    use Http;

    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the users.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->service->getUsers();

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    /**
     * Store a newly created user in storage.
     *
     * @param StoreUserRequest $request - Request with validated user data.
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        try {
            $data = $this->service->createUser($request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    /**
     * Display the specified user.
     *
     * @param string $userEmail - Email of the user to be displayed.
     * @return JsonResponse
     */
    public function show(string $userEmail): JsonResponse
    {
        try {
            $data = $this->service->getUser($userEmail);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    /**
     * Update the specified user in storage.
     *
     * @param string $userId - ID of the user to be updated.
     * @param UpdateUserRequest $request - Request with validated user data.
     * @return JsonResponse
     */
    public function update(string $userId, UpdateUserRequest $request): JsonResponse
    {
        try {
            $data = $this->service->updateUser($userId, $request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param string $userId - ID of the user to be deleted.
     * @return JsonResponse
     */
    public function destroy(string $userId): JsonResponse
    {
        try {
            $data = $this->service->deleteUser($userId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }
}
