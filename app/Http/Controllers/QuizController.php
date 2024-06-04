<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends BaseController
{
    public function test()
    {
        return $this->inertia('Quiz/Quiz');
    }
}
