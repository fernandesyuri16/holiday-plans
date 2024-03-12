<?php

namespace App\Http\Controllers;

use App\Helpers\Http;
use App\Http\Requests\HolidayPlan\StoreHolidayPlanRequest;
use App\Http\Requests\HolidayPlan\UpdateHolidayPlanRequest;
use App\Services\HolidayPlanService;
use Illuminate\Http\JsonResponse;

class HolidayPlanController extends Controller
{
    use Http;

    private HolidayPlanService $service;

    public function __construct(HolidayPlanService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        try {
            $data = $this->service->getHolidayPlans();

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function store(StoreHolidayPlanRequest $request): JsonResponse
    {
        try {
            $data = $this->service->createHolidayPlan($request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function show(int $holidayPlanId): JsonResponse
    {
        try {
            $data = $this->service->getHolidayPlan($holidayPlanId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function update(int $holidayPlanId, UpdateHolidayPlanRequest $request): JsonResponse
    {
        try {
            $data = $this->service->updateHolidayPlan($holidayPlanId, $request->validated());

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function destroy(int $holidayPlanId): JsonResponse
    {
        try {
            $data = $this->service->deleteHolidayPlan($holidayPlanId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }

    public function generatePdf(int $holidayPlanId): JsonResponse
    {
        try {
            $data = $this->service->generatePdf($holidayPlanId);

            return response()->json($data['response'], $data['code']);
        } catch (\Throwable $th) {
            $data = $this->serverError();

            dd($th->getMessage());

            return response()->json($data['response'], $data['code']);
        }
    }
}
