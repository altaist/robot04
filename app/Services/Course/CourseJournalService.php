<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Models\Journal;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CourseJournalService extends BaseService
{

    public function checkInUser(string $userKey)
    {
        $user = User::with('courses')
            ->where('skud_uuid', $userKey)
            ->firstOrFail();

        $courses = $user->courses;

        $activeCourse = $courses->where(function ($course) {
            return $course->checkCourseIsActual(now());
        })->first();

        if (!$activeCourse) {
            return null;
        }
        $recentRequestsCount = Journal::query()
            ->where('user_id', $user->id)
            ->where('course_id', $activeCourse->id)
            ->where('created_at', '>', now()->subMinutes(15))
            ->count();
        if ($recentRequestsCount) {
            return null;
        }
        $journal = Journal::create(['user_id' => $user->id, 'course_id' => $activeCourse->id]);
        return $journal;
    }

    public function checkCourseIsActual(Course $course, Carbon $byDate = null): bool
    {
        $schedule = $course->schedule;
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

        $val = data_get($day, 0);
        $dateFrom = Carbon::createFromFormat('H:i', $val)->setDateFrom($currentDate);
        $val = data_get($day, 1);
        $dateTo = Carbon::createFromFormat('H:i', $val)->setDateFrom($currentDate);

        //dd($currentDate, $dateFrom, $dateTo);
        return $currentDate->betweenIncluded($dateFrom, $dateTo);
    }
}
