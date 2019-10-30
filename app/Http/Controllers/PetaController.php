<?php

namespace App\Http\Controllers;

use App\User;
use Auth; // mengetahui siapa yang login
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Wisata;
use App\Category;
use Session;

class PetaController extends Controller
{
    public function lihatPeta(){
        $wisata = Wisata::with('category')->get();
        $categories = Category::all();
        return view('admin.peta.index', compact('wisata', 'categories'));
    }

    public function kategoriWisata(Request $request)
    {
        $wisata = Wisata::with('category')->where('id_kategori', $request->id)->get();
        $categories = Category::all();
        $catName = Category::where('id', $request->id)->pluck('kategori')->first();
        return view('admin.peta.index', compact('wisata', 'categories', 'catName'));
    }

    public function search(Request $request)
    {   
        $search = $request->keyword;
        if (!empty($search)) {
            $categories = Category::all();
            $wisata = Wisata::with('category')->where('nama', 'LIKE', '%'.$search.'%')
                                ->orWhere('alamat', 'LIKE', '%'.$search.'%')
                                ->get();
            // dd($wisata);
            if ($wisata->count() > 0) {
                Session::flash('success', 'Pencarian "'.$search.'" ditemukan!');
                return view('admin.peta.index', compact('categories', 'wisata'));
            } else {
                // silahkan ganti pesan error sesuai dengan yang diinginkan
                Session::flash('error', 'Pencarian "'.$search.'" tidak ditemukan! | Sistem menampilkan semua wisata');
                return redirect(route('peta.index'));
            }
        }
        
        Session::flash('error', 'Kata kunci pencarian masih kosong! | Sistem menampilkan semua wisata');
        return redirect(route('peta.index'));
        // if (!empty($search)) {
        //     $categories = Category::all();
        //     $wisata = [];
        //     if ($search) {
        //         $wisata = Wisata::with('category')->where('nama', 'LIKE', '%'. $search .'%')
        //         ->orWhere('alamat', 'LIKE', '%'. $search .'%')
        //         ->get();

        //         if ($wisata->count() != 0) {
        //             Session::flash('success', 'Pencarian Wisata "'.$search.'" Ditemukan!');
        //         } else {
        //             Session::flash('error', 'Data Wisata Tidak Ditemukan!');
        //             $wisata = Wisata::all();
        //             return redirect()->back()->with(compact('wisata', 'categories'));
        //         }
            
        //         return view('admin.peta.index')->with(['wisata' => $wisata, 'categories' => $categories]);
        //     }
        // } else {
        //     Session::flash('error', 'Kolom Pencarian Masih Kosong!');
        //     $wisata = Wisata::all();
        //     return redirect()->back()->with(compact('wisata', 'categories'));
        // }

        // return view('admin.peta.index')->with(['wisata' => $wisata, 'categories' => $categories]);


        // $categories = Category::all();
        // $keyword = $request->keyword;
        // if ($request->keyword) {
        //     $wisata = Wisata::where(function ($query) use ($keyword){
        //         $query->where('nama', 'LIKE', "%$keyword%")
        //                 ->orWhere('alamat', 'LIKE', "%$keyword%");
        //     })->get();
        //     if ($wisata) {
        //         Session::flash('success', 'Data Wisata Ditemukan!');
        //         return view('admin.peta.index', compact('wisata', 'categories'));
        //     } else {
        //         Session::flash('error', 'Data Wisata Tidak Ditemukan!');
        //         $wisata = Wisata::all();
        //         return redirect()->back()->with(compact('wisata', 'categories'));
        //     }
        // }
    }
}
