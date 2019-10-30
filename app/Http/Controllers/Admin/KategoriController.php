<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Validator;
use Session;
use Auth;
use Image;

class KategoriController extends Controller
{
    public function dataKategori(){
        $categories = Category::all();
        return view('admin.kategori.index', compact('categories'));
    }
    
    public function tambahKategori(){
        return view('admin.kategori.tambah-kategori');
    }

    public function simpanKategori(Request $r){
        $validator = Validator::make($r->all(),[
            'kategori' => 'required',
            'marker' => 'required|image|max:3000|mimes:jpeg,jpg,png',
        ]);
        $kategori = Category::where('kategori','=',$r->kategori)->first();
        if(!$validator->fails()){
            if(!$kategori){
                $gambar = $r->file('marker');
                $filename = time() . '.' . $gambar->getClientOriginalExtension();
                if ($r->file('marker')->isValid()) {
                    Image::make($gambar)->resize(32, 37)->save(public_path('/backend/images/marker/'.$filename));
                    $file = Category::create([
                        'kategori' => $r->kategori,
                        'marker' => $filename,
                        'id_user' => Auth::id()
                    ]);
                }
                Session::flash('success', 'Kategori baru berhasil ditambahkan!');
                return redirect(url('admin/kategori/data-kategori'));
            }else{           
                Session::flash('error', $r->kategori.' Kategori ini sudah ada!');
                return redirect()->back()->withInput();
            }
        }else{
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        }
    }

    public function deleteKategori($id){
        $delete = Category::find($id)->delete();
        Session::flash('success', 'Data Berhasil di Hapus!');
        return redirect(url('admin/kategori/data-kategori'));
    }

    public function editKategori($id){
        $categories = Category::where('id','=',$id)->first();
        return view('admin.kategori.edit-kategori', compact('categories'));
    }

    public function updateKategori(Request $r, $id){
        $validator = Validator::make($r->all(),[
            'kategori' => 'required',
        ]);
        if(!$validator->fails()){
            if($r->marker != null){
                $gambar = $r->file('marker');
                $filename = time() . '.' . $gambar->getClientOriginalExtension();
                if ($r->file('marker')->isValid()) {
                    Image::make($gambar)->resize(32, 37)->save(public_path('/backend/images/marker/'.$filename));
                    $file = Category::findOrFail($id)->update([
                        'kategori' => $r->kategori,
                        'marker' => $filename
                    ]);
                }
                Session::flash('success', 'Kategori berhasil di Update!');
                return redirect(url('admin/kategori/data-kategori'));
            }else{
                $file = Category::findOrFail($id)->update([
                    'kategori' => $r->kategori
                ]);
                Session::flash('success','Kategori Berhasil di Update!');
                return redirect(url('admin/kategori/data-kategori'));
            }
        }else{
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        }
    }
}
