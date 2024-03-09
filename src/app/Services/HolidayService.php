<?php

namespace App\Services;

use App\Helpers\Http;
use App\Repositories\HolidayRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class HolidayService
{
    use Http;

    private HolidayRepository $repository;
    private UserRepository $userRepository;


    public function __construct()
    {
        $this->repository = new HolidayRepository;
    }

    public function createHoliday(array $holidayDetails): array
    {
        $holidayDetails['password'] = Hash::make($holidayDetails['password']);

        $holiday = $this->repository->createHoliday($holidayDetails);

        return $this->created($holiday);
    }

    public function getHoliday(int $holidayId): array
    {
        $error = $this->checkIfHasError($holidayId);

        if (! empty($error)) {
            return $error;
        }

        $holiday = $this->repository->getHolidayById($holidayId);

        return $this->ok($holiday);
    }

    private function checkIfHasError(int $holidayId, bool $checkPermission = false): array
    {
        if (! $this->holidayExists($holidayId)) {
            return $this->notFound("Holiday doesn't exists.");
        }

        if ($checkPermission && $holidayId !== auth()->user()->id) {
            return $this->forbidden("You don't have permission to update or delete this holiday.");
        }

        return [];
    }

    private function holidayExists(int $holidayId): bool
    {
        $holiday = $this->repository->getHolidayById($holidayId);

        if (empty($holiday->id)) {
            return false;
        }

        return true;
    }

    public function updateHoliday(int $holidayId, array $holidayDetails): array
    {
        $error = $this->checkIfHasError($holidayId, true);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->updateHoliday($holidayId, $holidayDetails);

        $user = $this->repository->getHolidayById($holidayId);

        return $this->ok($user);
    }

    public function deleteHoliday(int $holidayId): array
    {
        $error = $this->checkIfHasError($holidayId, true);

        if (! empty($error)) {
            return $error;
        }

        $this->repository->deleteHoliday($holidayId);

        return $this->ok('User successfully deleted!');
    }
}
