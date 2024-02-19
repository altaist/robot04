<?php

namespace App\Services\Course;

use App\Services\BaseService;
use Illuminate\Support\Carbon;

class CourseScheduleService extends BaseService
{
    private static $timeZone = "+7:00";

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
            $dateFrom = Carbon::createFromFormat('H:i', data_get($day, 0), self::$timeZone)->setDateFrom($currentDate);
            $dateTo = Carbon::createFromFormat('H:i', data_get($day, 1), self::$timeZone)->setDateFrom($currentDate);
            // dd($dateFrom->toString(), $dateTo->toString(), $currentDate->toString(), $currentDate->betweenIncluded($dateFrom, $dateTo));
            return $currentDate->betweenIncluded($dateFrom, $dateTo);
        } catch (\Throwable $th) {
            return false;
        }
    }


}
