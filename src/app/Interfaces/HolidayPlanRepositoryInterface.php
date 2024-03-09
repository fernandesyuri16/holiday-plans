<?php

namespace App\Interfaces;

interface HolidayRepositoryInterface
{
    public function createHoliday(array $holidayDetails);
    public function getHolidayById(int $holidayId);
    public function updateHoliday(int $holidayId, array $holidayDetails);
    public function deleteHoliday(int $holidayId);
}
