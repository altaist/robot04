<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Models\Journal;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CourseService extends BaseService
{
    public function getCurrentlyActiveCourseForUser(User $user)
    {
        return $this->getCurrentlyActiveCourses($user->courses);
    }

    public function getCurrentlyActiveCourses(Collection $courses)
    {
        $date = now();

        $activeCourse = $courses->firstWhere(function ($course) use($date) {
            return $this->checkCourseIsActual($course, $date);
        });
        //dd($courses->count(), $activeCourse);

        return $activeCourse;
    }

    public function checkCourseIsActual(Course $course, Carbon $byDate = null): bool
    {
        $r = CourseScheduleService::checkScheduleIsActual($course->schedule, $byDate);
        //dd($course->schedule, $byDate, $r);
        //print_r("$course->id $r \n");
        return $r;
        return CourseScheduleService::checkScheduleIsActual($course->schedule, $byDate);
    }


}
