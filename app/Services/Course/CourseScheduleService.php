<?php

namespace App\Services\Course;

use App\Services\BaseService;
use Illuminate\Support\Carbon;

class CourseScheduleService extends BaseService
{

    public static function checkScheduleIsActual($schedule, Carbon $byDate = null): bool
    {
        if (!$schedule) {
            return false;
        }

        $days = $schedule->days ?? null;
        if (!$days) {
            return false;
        }

        $currentDate = $byDate ?? now();
        $weekday = $currentDate->isoWeekday() - 1;

        $day = data_get($days, $weekday);
        if (!$day) {
            return false;
        }

        try {
            $dateFrom = Carbon::createFromFormat('H:i', data_get($day, 0))->setDateFrom($currentDate);
            $dateTo = Carbon::createFromFormat('H:i', data_get($day, 1))->setDateFrom($currentDate);
            return $currentDate->betweenIncluded($dateFrom, $dateTo);
        } catch (\Throwable $th) {
            return false;
        }
    }


}
