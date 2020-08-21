<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
  public function index()
    {
        $user = Auth::user();
        $players=$user->players()->get();
        return $players;
    }
}
