<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Journal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class JournalController extends BaseController
{
    public function store(Request $request)
    {
        $key = $request->get('key');

        return response('error');
    }

}
