<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Activity;
use App\Http\Resources\ActivityResource;

class ActivityController extends Controller
{
    public function index()
    {
        return ActivityResource::collection(Activity::get());
    }
}
