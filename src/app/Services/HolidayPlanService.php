<?php

namespace App\Services;

use App\Helpers\Http;
use App\Repositories\HolidayPlanRepository;
use App\Repositories\UserRepository;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;

class HolidayPlanService
{
    use Http;

    private HolidayPlanRepository $repository;
    private UserRepository $userRepository;


    public function __construct()
    {
        $this->repository = new HolidayPlanRepository;
    }

    public function createHolidayPlan(array $holidayPlanDetails): array
    {
        $holidayPlanDetails['user_id'] = auth()->user()->id;

        $holidayPlan = $this->repository->createHolidayPlan($holidayPlanDetails);

        return $this->created($holidayPlan);
    }

    public function getHolidayPlan(int $holidayId): array
    {
        $error = $this->checkIfHasError($holidayId);

        if (! empty($error)) {
            return $error;
        }

        $holidayPlan = $this->repository->getHolidayPlan($holidayId);

        return $this->ok($holidayPlan);
    }

    public function getHolidayPlans(): array
    {
        $holidayPlans = $this->repository->getHolidayPlans();

        return $this->ok($holidayPlans->items());
    }

    private function checkIfHasError(int $holidayId, bool $checkPermission = false): array
    {
        if (! $this->holidayPlanExists($holidayId)) {
            return $this->notFound("Holiday doesn't exists.");
        }

        if ($checkPermission && $holidayId !== auth()->user()->id) {
            return $this->forbidden("You don't have permission to update or delete this holiday.");
        }

        return [];
    }

    private function holidayPlanExists(int $holidayId): bool
    {
        $holiday = $this->repository->getHolidayPlan($holidayId);

        if (empty($holiday->id)) {
            return false;
        }

        return true;
    }

    public function updateHolidayPlan(int $holidayId, array $holidayPlanDetails): array
    {
        $error = $this->checkIfHasError($holidayId, true);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->updateHolidayPlan($holidayId, $holidayPlanDetails);

        $user = $this->repository->getHolidayPlan($holidayId);

        return $this->ok($user);
    }

    public function deleteHolidayPlan(int $holidayId): array
    {
        $error = $this->checkIfHasError($holidayId, true);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->deleteHolidayPlan($holidayId);

        return $this->ok('User successfully deleted!');
    }

    public function generatePdf(int $holidayId): array
    {
        $error = $this->checkIfHasError($holidayId);

        if (! empty($error)) {
            return $error;
        }

        $holidayPlan = $this->repository->getHolidayPlan($holidayId);

        $viewData = $holidayPlan->toArray();

        $viewData['userName'] = $holidayPlan->user->name;

        $html = view('holiday-plan-pdf', compact('viewData'))->render();

        return $this->ok($html);
    }
}
