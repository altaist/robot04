<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Journal;
use App\Models\User;
use App\Services\Course\CourseJournalService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class JournalController extends BaseController
{
    public function checkIn(string $key, Request $request)
    {
        $user = User::with('courses')
        ->where('external_key', $key)
        ->first();


        if(!$user){
            return 'error';
        }
//        dd($user, $key);

        $journalService = CourseJournalService::make();
        $journal = $journalService->userCheckIn($user);
        if($journal){
            return response('ok');
        }

        return response('error');
    }
}
