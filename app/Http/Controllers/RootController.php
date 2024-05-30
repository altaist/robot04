<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RootController extends BaseController
{
    public function index(Request $request)
    {
        $view = data_get(config('project.project_views'), env('PROJECT_ID', ''), 'default');
        // dd($view, config('project.project_views'));
        return view($view);
    }
}
