<?php

namespace App\Http\Controllers;

use App\Helpers\Http;
use App\Http\Requests\HolidayPlan\StoreHolidayPlanRequest;
use App\Http\Requests\HolidayPlan\UpdateHolidayPlanRequest;
use App\Services\HolidayPlanService;
use Illuminate\Http\JsonResponse;

/**
 * Class HolidayPlanController
 *
 * This class is responsible for handling operations related to holiday plans.
 */
class HolidayPlanController extends Controller
{
    use Http;

    /**
     * @var HolidayPlanService Holiday plan service
     */
    private HolidayPlanService $service;

    public function __construct(HolidayPlanService $service)
    {
        $this->service = $service;
    }

    /**
     * Fetches all holiday plans
     *
     * @return JsonResponse JSON response containing all holiday plans or an error
     */
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

    /**
     * Stores a new holiday plan
     *
     * @param StoreHolidayPlanRequest $request Validated store holiday plan request
     * @return JsonResponse JSON response indicating the result of the store operation
     */
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

    /**
     * Fetches a specific holiday plan
     *
     * @param int $holidayPlanId ID of the holiday plan to fetch
     * @return JsonResponse JSON response containing the holiday plan or an error
     */
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

    /**
     * Updates a specific holiday plan
     *
     * @param int $holidayPlanId ID of the holiday plan to update
     * @param UpdateHolidayPlanRequest $request Validated update holiday plan request
     * @return JsonResponse JSON response indicating the result of the update operation
     */
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

    /**
     * Deletes a specific holiday plan
     *
     * @param int $holidayPlanId ID of the holiday plan to delete
     * @return JsonResponse JSON response indicating the result of the delete operation
     */
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

    /**
     * Generates a PDF for a specific holiday plan
     *
     * @param int $holidayPlanId ID of the holiday plan to generate a PDF for
     * @return mixed The generated PDF or an error
     */
    public function generatePdf(int $holidayPlanId): mixed
    {
        try {
            $data = $this->service->generatePdf($holidayPlanId);

            return $data;
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }
}
