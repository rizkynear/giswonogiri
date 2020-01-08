<?php

namespace App\Http\Controllers;

use App\Category;
use App\Wisata;
use Illuminate\Http\Request;

class PetaController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $wisatas    = Wisata::with('category')->get();
        
        return view('user.peta.index', compact('wisatas', 'categories'));
    }
    
    public function search(Request $request)
    {
        
        $wisata = Wisata::with('category')->where('id', '!=', 0);
        
        if (!empty($request->id) && $request->id != 'all') {
            $wisata->where('id_kategori', '=', $request->id);
        }
        
        if (!empty($request->search)) {
            $wisata->where('nama', 'LIKE', "%{$request->search}%")->orWhere('alamat', 'LIKE', "%{$request->search}%");
        }

        if (empty($request->search) && empty($request->id)) {
            $wisata->where('nama', '=', 'fail');
        }

        $wisatas = $wisata->get();

        return response()->json(['wisatas' => $wisatas]);
    }
}
