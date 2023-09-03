<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public $table = "kategoris";

    public function index() {
          
        return view('kategori.index', [
            'kategoris' => Kategori::latest()->get(),
        ]);
    }

    public function create(){
        return view('kategori.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'nama_kategori' => ['required'],
        ],
        [
            'nama_kategori.required' => 'Kolom Kategori harus di isi',
        ]);
        $kategori  = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
        return redirect()->route('kategori.index');
    }

    public function edit($id){

        $kategori = Kategori::find($id);
        return view('kategori.edit',[
            'kategori'=>$kategori,
        ]);
    }

    public function update(Request $request,$id){
        $kategori  = Kategori::find($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
        return redirect()->route('kategori.index');
    }

}
