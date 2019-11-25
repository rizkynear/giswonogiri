<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdminController extends Controller
{
    public function dataAdmin()
    {
        $admins = User::withTrashed()->where('status', 'admin')->get();
        return view('super-admin.admin.index', compact('admins'));
    }

    public function tambahAdmin() 
    {
        return view('super-admin.admin.tambah-admin');
    }

    public function deleteAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back();
    }

    public function restoreAdmin($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->back();
    }
}
