<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

/**
 * Class AuthController
 *
 * This class is responsible for handling authentication operations.
 */
class AuthController extends Controller
{
    /**
     * @var AuthService Authentication service
     */
    private AuthService $service;

    /**
     * AuthController class constructor
     *
     * @param AuthService $service Authentication service
     */
    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    /**
     * Generates an authentication token
     *
     * @param LoginRequest $request Validated login request
     * @return JsonResponse JSON response containing the authentication token or an error
     */
    public function generateToken(LoginRequest $request): JsonResponse
    {
        try {
            $data = $this->service->generateToken($request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    /**
     * Logs out the user
     *
     * @return JsonResponse JSON response indicating the result of the logout operation
     */
    public function logout(): JsonResponse
    {
        try {
            $data = $this->service->logout();

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }
}