<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.home');
    }

    public function getUsers()
    {
        $users = User::select([
            '*',
            DB::raw("(SELECT SUM(points) FROM user_referals WHERE user_referals.refered_user_id = users.id) AS points")
        ])->with('user.user');

        return DataTables::of($users)
        ->addColumn('refered_user', function($user) {
            try {
                return $user->user->user->name;
            } catch (\Exception $th) {
                return '';
            }
        })
        ->editColumn('points', function($user) {
            return $user->points ? $user->points : 0;
        })
        ->rawColumns(['refered_user'])
        ->make(true);
    }
}
