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
        $activity=Activity::get();
        return ActivityResource::collection($activity);
    }
}
