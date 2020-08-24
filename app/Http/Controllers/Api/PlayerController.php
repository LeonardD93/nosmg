<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PlayerResource;
use App\Http\Resources\ParamPlayerResource;
//use App\Param;

class PlayerController extends Controller {
    public function index(){
        return PlayerResource::collection(Auth::user()->players);
    }
}
