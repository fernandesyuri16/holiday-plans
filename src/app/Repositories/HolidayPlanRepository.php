<?php

namespace App\Repositories;

use App\Interfaces\HolidayPlanRepositoryInterface;
use App\Models\HolidayPlan;

class HolidayPlanRepository implements HolidayPlanRepositoryInterface
{
    public function createHolidayPlan(array $holidayPlanDetails): HolidayPlan
    {
        return HolidayPlan::create($holidayPlanDetails);
    }

    public function getHolidayPlans()
    {
        return HolidayPlan::all();
    }

    public function getHolidayPlan(int $holidayPlanId): ?HolidayPlan
    {
        return HolidayPlan::find($holidayPlanId);
    }

    public function updateHolidayPlan(int $holidayPlanId, array $holidayPlanDetails): void
    {
        HolidayPlan::whereId($holidayPlanId)->update($holidayPlanDetails);
    }

    public function deleteHolidayPlan(int $holidayPlanId): void
    {
        HolidayPlan::destroy($holidayPlanId);
    }
}
