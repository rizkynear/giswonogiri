<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Wisata;
use App\Category;
use App\User;
use Validator;
use Session;
use Auth;
use Image;

class WisataController extends Controller
{
    public function tambahWisata(){
        $categories = Category::all();
        return view('admin.wisata.tambah-wisata', compact('categories'));
    }

    public function simpanWisata(Request $r){
        $validator = Validator::make($r->all(),[
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'keterangan' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png',
            'id_kategori' => 'required',
        ]);
        $wisata = Wisata::where('nama','=',$r->nama)->first();
        if(!$validator->fails()){
            if(!$wisata){
                $gambar = $r->file('foto');
                $filename = time() . '.' . $gambar->getClientOriginalExtension();
                if ($r->file('foto')->isValid()) {
                    Image::make($gambar)->resize(500, 250)->save(public_path('/backend/images/fotowisata/'.$filename));
                    $file = Wisata::create([
                        'nama' => $r->nama,
                        'foto' => $filename,
                        'alamat' => $r->alamat,
                        'no_telp' => $r->no_telp,
                        'keterangan' => $r->keterangan,
                        'lat' => $r->lat,
                        'long' => $r->long,
                        'foto' => $filename,
                        'id_kategori' => $r->id_kategori,
                        'id_user' => Auth::id()
                    ]);
                }
                Session::flash('success', 'Destinasi wisata baru berhasil ditambahkan!');
                return redirect(url('admin/wisata/data-wisata'));
            }else{           
                Session::flash('error', $r->kategori.' Destinasi wisata ini sudah ada!');
                return redirect()->back()->withInput();
            }
        }else{
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        }
    }

    public function dataWisata(){
        $wisatas = Wisata::all();
        return view('admin.wisata.data-wisata', compact('wisatas'));
    }

    public function deleteWisata($id){
        $delete = Wisata::find($id)->delete();
        Session::flash('success', 'Data Berhasil di Hapus!');
        return redirect(url('admin/wisata/data-wisata'));
    }

    public function editWisata($id){
        $wisatas = Wisata::where('id','=',$id)->first();
        $categories = Category::all();
        return view('admin.wisata.edit-wisata', compact('wisatas','categories'));
    }

    // public function updateWisata(Request $r, $id){
    //     $validator = Validator::make($r->all(),[
    //         'nama' => 'required',
    //         'alamat' => 'required',
    //         'no_telp' => 'required',
    //         'keterangan' => 'required',
    //         'lat' => 'required',
    //         'long' => 'required',
    //         'id_kategori' => 'required',
    //     ]);
    //     if(!$validator->fails()){
    //         if($r->foto != null){
    //             $gambar = $r->file('foto');
    //             $filename = time() . '.' . $gambar->getClientOriginalExtension();
    //             if ($r->file('foto')->isValid()) {
    //                 Image::make($gambar)->resize(500, 250)->save(public_path('/backend/images/fotowisata/'.$filename));
    //                 $file = Category::findOrFail($id)->update([
    //                     'nama' => $r->nama,
    //                     'alamat' => $r->alamat,
    //                     'no_telp' => $r->no_telp,
    //                     'keterangan' => $r->keterangan,
    //                     'lat' => $r->lat,
    //                     'long' => $r->long,
    //                     'foto' => $filename,
    //                     'id_kategori' => $r->id_kategori
    //                 ]);
    //             }
    //             Session::flash('success', 'Data wisata berhasil di Update!');
    //             return redirect(url('admin/wisata/data-wisata'));
    //         }else{
    //             $file = Wisata::findOrFail($id)->update([
    //                 'nama' => $r->nama,
    //                 'alamat' => $r->alamat,
    //                 'no_telp' => $r->no_telp,
    //                 'keterangan' => $r->keterangan,
    //                 'lat' => $r->lat,
    //                 'long' => $r->long,
    //                 'id_kategori' => $r->id_kategori,
    //             ]);
    //             Session::flash('success','Data Wisata Berhasil di Update!');
    //             return redirect(url('admin/wisata/data-wisata'));
    //         }
    //     }else{
    //         Session::flash('error', $validator->messages()->first());
    //         return redirect()->back()->withInput();
    //     }
    // }

    public function updateWisata (Request $r, $id){
        $validator = Validator::make($r->all(),[
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'keterangan' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'id_kategori' => 'required',
        ]);
        if(!$validator->fails()){
            if($r->foto != null){
                $gambar = $r->file('foto');
                $filename = time() . '.' . $gambar->getClientOriginalExtension();
                if ($r->file('foto')->isValid()) {
                    Image::make($gambar)->resize(500, 250)->save(public_path('/backend/images/fotowisata/'.$filename));
                    $file = Wisata::findOrFail($id)->update([
                        'nama' => $r->nama,
                        'alamat' => $r->alamat,
                        'no_telp' => $r->no_telp,
                        'keterangan' => $r->keterangan,
                        'lat' => $r->lat,
                        'long' => $r->long,
                        'foto' => $filename,
                        'id_kategori' => $r->id_kategori
                    ]);
                }
                Session::flash('success', 'Data Wisata berhasil di Update!');
                return redirect(url('admin/wisata/data-wisata'));
            }else{
                $file = Wisata::findOrFail($id)->update([
                    'nama' => $r->nama,
                    'alamat' => $r->alamat,
                    'no_telp' => $r->no_telp,
                    'keterangan' => $r->keterangan,
                    'lat' => $r->lat,
                    'long' => $r->long,
                    'id_kategori' => $r->id_kategori
                ]);
                Session::flash('success','Kategori Berhasil di Update!');
                return redirect(url('admin/wisata/data-wisata'));
            }
        }else{
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        }
    }
}
