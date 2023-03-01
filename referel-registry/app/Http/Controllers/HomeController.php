<?php

namespace App\Http\Controllers;

use App\Models\UserReferals;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $points = UserReferals::whereHas('refered_user', function($query) {
            $query->where('refered_user_id', auth()->user()->id);
        })->sum('points');
        return view('home', compact('points'));
    }

    public function homePage()
    {
        return view('main_home');
    }
}
