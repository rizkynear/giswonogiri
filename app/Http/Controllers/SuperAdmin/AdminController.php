<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdminController extends Controller
{
    public function dataAdmin(){
        $admins = User::where('status', 'admin')->get();
        return view('super-admin.admin.index', compact('admins'));
    }
}
