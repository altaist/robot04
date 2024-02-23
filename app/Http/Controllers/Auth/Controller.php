<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseRoutingController;

class Controller extends BaseRoutingController
{
    use AuthorizesRequests, ValidatesRequests;
}
