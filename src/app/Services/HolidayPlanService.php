<?php

namespace App\Services;

use App\Helpers\Http;
use App\Repositories\HolidayPlanRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class HolidayPlanService
{
    use Http;

    private HolidayPlanRepository $repository;
    private UserRepository $userRepository;


    public function __construct()
    {
        $this->repository = new HolidayPlanRepository;
    }

    public function createHolidayPlan(array $holidayDetails): array
    {
        $holidayDetails['password'] = Hash::make($holidayDetails['password']);

        $holiday = $this->repository->createHolidayPlan($holidayDetails);

        return $this->created($holiday);
    }

    public function getHolidayPlan(int $holidayId): array
    {
        $error = $this->checkIfHasError($holidayId);

        if (! empty($error)) {
            return $error;
        }

        $holiday = $this->repository->getHolidayPlan($holidayId);

        return $this->ok($holiday);
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

    public function updateHolidayPlan(int $holidayId, array $holidayDetails): array
    {
        $error = $this->checkIfHasError($holidayId, true);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->updateHolidayPlan($holidayId, $holidayDetails);

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
}
