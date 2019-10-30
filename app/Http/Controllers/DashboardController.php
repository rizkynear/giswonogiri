<?php

namespace App\Http\Controllers;

use App\User;
use Auth; // mengetahui siapa yang login
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function indexDashboard(){
        $users = User::where('id', Auth::user()->id)->first();
        return view('admin.dashboard.index', compact('users'));
    }
}
