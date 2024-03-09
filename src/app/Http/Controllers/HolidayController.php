<?php

namespace App\Http\Controllers;

use App\Helpers\Http;
use App\Http\Requests\User\StoreHolidayRequest;
use App\Http\Requests\User\UpdateHolidayRequest;
use App\Services\HolidayService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    use Http;

    private HolidayService $service;

    public function __construct()
    {
        $this->service = new HolidayService();
    }

    public function store(StoreHolidayRequest $request): JsonResponse
    {
        try {
            $data = $this->service->createHoliday($request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function show(string $userEmail): JsonResponse
    {
        try {
            $data = $this->service->getHoliday($userEmail);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function update(string $userId, UpdateHolidayRequest $request): JsonResponse
    {
        try {
            $data = $this->service->updateHoliday($userId, $request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function destroy(string $userId): JsonResponse
    {
        try {
            $data = $this->service->deleteHoliday($userId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }
}
