<?php

namespace App\Http\Controllers;

use App\Http\Resources\Journal\JournalResource;
use App\Http\Resources\Journal\JournalResourceCollection;
use App\Models\Course;
use App\Models\Journal;
use App\Models\Lesson;
use App\Models\User;
use App\Services\Course\CourseJournalService;
use Illuminate\Http\Request;

class JournalController extends BaseController
{
    public function checkInByCardKey(string $key, Request $request)
    {
        $user = User::with('courses')
            ->where('skud_key', $key)
            ->first();


        if(!$user){
            return 'Error: Wrong card';
        }

        $journalService = CourseJournalService::make();
        $journal = $journalService->userCheckIn($user);
        if($journal){
            return response($user->first_name);
        }

        return response('Error: We are closed');
    }

    public function userLessonCheckIn(string $lessonId, string $userId)
    {
        $lesson = Lesson::findOrFail($lessonId);
        $user = User::findOrFail($userId);

        $journalItem = Journal::firstOrCreate(['user_id' => $userId, 'lesson_id' => $lessonId]);
        $this->response(JournalResource::collection($journalItem));
    }

    public function userLessonCheckOut(string $lessonId, string $userId)
    {
        Journal::where(['user_id' => $userId, 'lesson_id' => $lessonId])->delete();
        $this->responseOk();
    }

    public function index()
    {
        $journalCollection = Journal::with('journalable', 'user')
            ->orderBy('journalable_type')
            ->orderBy('journalable_id')
            ->orderBy('updated_at', 'desc')
            ->get();

        return $this->inertiaFromResource('Journal/TestJournal', JournalResource::collection($journalCollection));
    }
}
