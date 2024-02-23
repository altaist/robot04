<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Models\Journal;
use App\Models\User;
use App\Services\BaseService;


class CourseJournalService extends BaseService
{

    public function userCheckIn(User $user)
    {
        $courseService = CourseService::make();
        $activeCourse = $courseService->getCurrentlyActiveCourseForUser($user);

        if (!$activeCourse) {
            return null;
        }

        return $this->updateJournalForUserCheckIn($user, $activeCourse);
    }

    public function updateJournalForUserCheckIn(User $user, Course $activeCourse)
    {
        $journal = $activeCourse
            ->journalRecords()
            ->where('user_id', $user->id)
            ->where('created_at', '>', now()->subMinutes(30))
            ->latest()
            ->first();

        if (!$journal) {
            $journal = Journal::create(['user_id' => $user->id, 'journalable_type' => 'course', 'journalable_id' => $activeCourse->id]);
        }

        return $journal;
    }
}
