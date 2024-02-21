<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Journal;
use App\Models\User;
use App\Services\Course\CourseJournalService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;

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

    public function index()
    {
        $journal = Journal::with('journalable', 'user')
            ->orderBy('journalable_type')
            ->orderBy('journalable_id')
            ->orderBy('updated_at', 'desc')
            ->get();
        //dd($journal[0]->journalable);
        //return view('edu/journal', ["items"=>$journal]);
        return Inertia::render('Course/Journal', ['journal' => $journal]);
    }
}
