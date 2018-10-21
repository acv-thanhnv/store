<?php

namespace App\Manager\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
