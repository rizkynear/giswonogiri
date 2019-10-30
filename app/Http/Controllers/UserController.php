<?php

namespace App\Http\Controllers;

use App\User;
use Auth; // mengetahui siapa yang login
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Image;

class UserController extends Controller
{
    public function dataUser(){
        $users = User::where('id', Auth::user()->id)->first();
        return view('admin.user.data-user', compact('users'));
    }

    public function updateUser(Request $r, $id){
        $validator = Validator::make($r->all(),[
            'nama' => 'required',
            'email' => 'required',
            'username' => 'required'
        ]);
        if(!$validator->fails()){
            if($r->foto == null AND $r->password == null){
                $file = User::findOrFail($id)->update([
                    'nama' => $r->nama,
                    'email' => $r->email,
                    'username' => $r ->username
                ]);
                Session::flash('success','Data Profil Berhasil di Update!');
                return redirect(url('admin/user/data-user'));
            }elseif($r->foto == null AND $r->password != null){
                $file = User::findOrFail($id)->update([
                    'nama' => $r->nama,
                    'email' => $r->email,
                    'username' => $r ->username,
                    'password' => bcrypt($r->password)
                ]);
                Session::flash('success','Data Profil Berhasil di Update!');
                return redirect(url('admin/user/data-user'));
            }elseif($r->foto != null AND $r->password == null){
                $gambar = $r->file('foto');
                $filename = time() . '.' . $gambar->getClientOriginalExtension();
                if ($r->file('foto')->isValid()) {
                    Image::make($gambar)->resize(500, 500)->save(public_path('/backend/images/fotoprofil/'.$filename));
                    $file = User::findOrFail($id)->update([
                        'nama' => $r->nama,
                        'email' => $r->email,
                        'username' => $r ->username,
                        'foto' => $filename
                    ]);
                    Session::flash('success','Data User Berhasil di Update!');
                    return redirect(url('admin/user/data-user'));
                }
            }elseif($r->foto != null AND $r->password == !null){
                $gambar = $r->file('foto');
                $filename = time() . '.' . $gambar->getClientOriginalExtension();
                if ($r->file('foto')->isValid()) {
                    Image::make($gambar)->resize(500, 500)->save(public_path('/backend/images/fotoprofil/'.$filename));
                    $file = User::findOrFail($id)->update([
                        'nama' => $r->nama,
                        'email' => $r->email,
                        'username' => $r ->username,
                        'password' => bcrypt($r->password),
                        'foto' => $filename
                    ]);
                    Session::flash('success','Data User Berhasil di Update!');
                    return redirect(url('admin/user/data-user'));
                }
            }
        }else{
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        }
    }
}
