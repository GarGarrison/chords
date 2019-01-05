<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\News;
// use App\Goods;
// use App\User;
// use Carbon\Carbon;

class MainController extends Controller
{
    public function index(Request $request) {
        return view('index');
    }
    public function song(Request $request) {
        return view('song');
    }
}
