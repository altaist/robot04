<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseRoutingController;
use Inertia\Inertia;

abstract class BaseController extends BaseRoutingController
{
    use AuthorizesRequests, ValidatesRequests;

    public function response($data, $status)
    {
        return response($data, $status);
    }

    public function responseInertia(string $componentName, array $data)
    {
        return Inertia::render($componentName, $data);
    }
}
