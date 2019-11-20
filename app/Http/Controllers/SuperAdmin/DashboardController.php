<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function indexDashboard(){
        $users = User::where('id', Auth::user()->id)->first();
        return view('super-admin.dashboard.index', compact('users'));
    }
}
