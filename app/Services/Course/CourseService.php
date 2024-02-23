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
            return CourseScheduleService::checkScheduleIsActual($course->schedule, $date);
        });

        return $activeCourse;
    }

}
