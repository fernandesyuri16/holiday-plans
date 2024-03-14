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
     * @OA\Get(
     *      path="/holiday-plans/",
     *      operationId="getHolidayPlans",
     *      tags={"HolidayPlan"},
     *      summary="",
     *      description="Endpoint to retrieve all holiday plans.",
     *      security={{"sanctum": {}}},
     *          response=200,
     *          description="Success, holiday plans found.",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="id", type="integer", example="1"),
     *                  @OA\Property(property="user_id", type="integer", example="20"),
     *                  @OA\Property(property="title", type="string", example="Travel to Lisbon"),
     *                  @OA\Property(property="descrtiption", type="string", example="Travel from the best city of europe"),
     *                  @OA\Property(property="date", type="string", format="date-time", example="2024-03-14"),
     *                  @OA\Property(property="location", type="string", example="Lisbon"),
     *                  @OA\Property(property="participants", type="integer", example="3"),
     *
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="id", type="integer", example="2"),
     *                  @OA\Property(property="user_id", type="integer", example="21"),
     *                  @OA\Property(property="title", type="string", example="Travel to Porto"),
     *                  @OA\Property(property="descrtiption", type="string", example="Travel from the best city of europe"),
     *                  @OA\Property(property="date", type="string", format="date-time", example="2024-03-14"),
     *                  @OA\Property(property="location", type="string", example="Porto"),
     *                  @OA\Property(property="participants", type="integer", example="3"),
     *
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="id", type="integer", example="3"),
     *                  @OA\Property(property="user_id", type="integer", example="22"),
     *                  @OA\Property(property="title", type="string", example="Travel to Braga"),
     *                  @OA\Property(property="descrtiption", type="string", example="Travel from the best city of europe"),
     *                  @OA\Property(property="date", type="string", format="date-time", example="2024-03-14"),
     *                  @OA\Property(property="location", type="string", example="Braga"),
     *                  @OA\Property(property="participants", type="integer", example="3"),
     *              )
     *          )
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Not found.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Holiday plan doesn't exists.")
     *          )
     *       ),
     *       @OA\Response(
     *          response=401,
     *          description="Invalid token.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Invalid token.")
     *          )
     *       ),
     *       @OA\Response(
     *          response=500,
     *          description="Internal error.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Internal error, contact an administrator."),
     *          )
     *       )
     * )
     */

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
     * @OA\Post(
     *      path="/holiday-plan",
     *      operationId="createHolidayPlan",
     *      tags={"HolidayPlans"},
     *      summary="",
     *      description="Endpoint to create a holiday plan.",
     *      security={{"sanctum": {}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="title", type="string", example="Travel to Lisbon"),
     *              @OA\Property(property="descrtiption", type="string", example="Travel from the best city of europe"),
     *              @OA\Property(property="date", type="string", format="date-time", example="2024-03-14"),
     *              @OA\Property(property="location", type="string", example="Lisbon"),
     *              @OA\Property(property="participants", type="integer", example="3"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Success, holiday plan created.",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="title", type="string", example="Travel to Lisbon"),
     *                  @OA\Property(property="descrtiption", type="string", example="Travel from the best city of europe"),
     *                  @OA\Property(property="date", type="string", format="date-time", example="2024-03-14"),
     *                  @OA\Property(property="location", type="string", example="Lisbon"),
     *                  @OA\Property(property="participants", type="integer", example="3"),
     *                  @OA\Property(property="user_id", type="integer", example="20"),
     *                  @OA\Property(property="created_at", type="string", format="date-time", example="2024-03-14T01:57:56.000000Z"),
     *                  @OA\Property(property="updated_at", type="string", format="date-time", example="2024-03-14T01:57:56.000000Z"),
     *                  @OA\Property(property="id", type="integer", example="1"),
     *              )
     *          )
     *       ),
     *       @OA\Response(
     *          response=500,
     *          description="Internal error.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Internal error, contact an administrator."),
     *          )
     *       )
     * )
     */

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
     * @OA\Get(
     *      path="/holiday-plans/{id}",
     *      operationId="getHolidayPlan",
     *      tags={"HolidayPlan"},
     *      summary="",
     *      description="Endpoint to consult a holiday plan.",
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Holiday plan ID",
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success, holiday plan found.",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="id", type="integer", example="1"),
     *                  @OA\Property(property="user_id", type="integer", example="20"),
     *                  @OA\Property(property="title", type="string", example="Travel to Lisbon"),
     *                  @OA\Property(property="descrtiption", type="string", example="Travel from the best city of europe"),
     *                  @OA\Property(property="date", type="string", format="date-time", example="2024-03-14"),
     *                  @OA\Property(property="location", type="string", example="Lisbon"),
     *                  @OA\Property(property="participants", type="integer", example="3"),
     *              )
     *          )
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Not found.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Holiday plan doesn't exists.")
     *          )
     *       ),
     *       @OA\Response(
     *          response=401,
     *          description="Invalid token.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Invalid token.")
     *          )
     *       ),
     *       @OA\Response(
     *          response=500,
     *          description="Internal error.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Internal error, contact an administrator."),
     *          )
     *       )
     * )
     */

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
     * @OA\Put(
     *      path="/holiday-plans/{id}",
     *      operationId="updateHolidayPlan",
     *      tags={"Users"},
     *      summary="",
     *      description="Endpoint to update a holiday plan.",
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Holiday plan ID",
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="title", type="string", example="Travel to Porto"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success, holiday plan updated.",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="id", type="integer", example="1"),
     *                  @OA\Property(property="user_id", type="integer", example="20"),
     *                  @OA\Property(property="title", type="string", example="Travel to Lisbon"),
     *                  @OA\Property(property="descrtiption", type="string", example="Travel from the best city of europe"),
     *                  @OA\Property(property="date", type="string", format="date-time", example="2024-03-14"),
     *                  @OA\Property(property="location", type="string", example="Lisbon"),
     *                  @OA\Property(property="participants", type="integer", example="3"),
     *                  @OA\Property(property="created_at", type="string", format="date-time", example="2024-03-14T01:57:56.000000Z"),
     *                  @OA\Property(property="updated_at", type="string", format="date-time", example="2024-03-14T01:57:56.000000Z"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Holiday plan doesn't exists.")
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Insufficient permission.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="You don't have permission to update or delete this Holiday plan.")
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Invalid token.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Invalid token.")
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal error.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Internal error, contact an administrator."),
     *          )
     *      )
     * )
     */

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
     * @OA\Delete(
     *      path="/holiday-plans/{id}",
     *      operationId="deleteHolidayPlan",
     *      tags={"HolidayPlan"},
     *      summary="",
     *      description="Endpoint to delete a Holiday plan.",
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Holiday plan ID",
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success, holiday plan deleted.",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object", example="Holiday plan successfully deleted.")
     *          )
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Not found.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Holiday plan doesn't exists.")
     *          )
     *       ),
     *       @OA\Response(
     *          response=403,
     *          description="Insufficient permission.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="You don't have permission to update or delete this Holiday plan.")
     *          )
     *       ),
     *       @OA\Response(
     *          response=401,
     *          description="Invalid token.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Invalid token.")
     *          )
     *       ),
     *       @OA\Response(
     *          response=500,
     *          description="Internal error.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Internal error, contact an administrator."),
     *          )
     *       )
     * )
     */

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
     * @OA\Get(
     *      path="/holiday-plans/{id}/pdf",
     *      operationId="generatePdf",
     *      tags={"HolidayPlan"},
     *      summary="",
     *      description="Endpoint to generate a Holiday plan pdf.",
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Holiday plan ID",
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success, pdf generated.",
     *          @OA\MediaType(
     *              mediaType="application/pdf",
     *              @OA\Schema(
     *                  type="string",
     *                  format="binary",
     *                  description="PDF file"
     *              )
     *           )
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Not found.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Holiday plan doesn't exists.")
     *          )
     *       ),
     *       @OA\Response(
     *          response=403,
     *          description="Insufficient permission.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="You don't have permission to update or delete this Holiday plan.")
     *          )
     *       ),
     *       @OA\Response(
     *          response=401,
     *          description="Invalid token.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Invalid token.")
     *          )
     *       ),
     *       @OA\Response(
     *          response=500,
     *          description="Internal error.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Internal error, contact an administrator."),
     *          )
     *       )
     * )
     */

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

            dd($data);
            return $data;
        } catch (\Throwable $th) {
            $data = $this->serverError();

            return response()->json($data['response'], $data['code']);
        }
    }
}
