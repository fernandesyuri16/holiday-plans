<?php

namespace App\Repositories;

use App\Interfaces\HolidayRepositoryInterface;
use App\Models\Holiday;

class HolidayRepository implements HolidayRepositoryInterface
{
    public function createHoliday(array $holidayDetails): Holiday
    {
        return Holiday::create($holidayDetails);
    }

    public function getHolidayById(int $holidayId): ?Holiday
    {
        return Holiday::find($holidayId);
    }

    public function getUserByEmail(string $userEmail): ?Holiday
    {
        return Holiday::where('email', $userEmail)->first();
    }

    public function updateHoliday(int $holidayId, array $holidayDetails): void
    {
        Holiday::whereId($holidayId)->update($holidayDetails);
    }

    public function deleteHoliday(int $holidayId): void
    {
        Holiday::destroy($holidayId);
    }
}
