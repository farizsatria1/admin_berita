<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public $table = "beritas";
    
    public function index() {
        
        return view('berita.index', [
            'beritas' => Berita::with('kategori')->get(),
        ]);
    }

    public function create(){
        
        $kategoriList = Kategori::pluck('nama_kategori', 'id');
        return view('berita.create', compact('kategoriList'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => ['required'],
            'author' => ['required'],
            'kategori_id' => ['required'],
            'created_at' => ['required'],
            'content' => ['required'],
        ],
        [
            'title.required' => 'Kolom judul harus di isi',
            'author.required' => 'Kolom author harus di isi',
            'kategori_id.required' => 'Kolom kategori harus di isi',
            'created_at.required' => 'Kolom tanggal harus di isi',
            'content.required' => 'Kolom berita harus di isi'
        ]);
        $berita  = new Berita();

        $berita->title = $request->title;
        $berita->author = $request->author;
        $berita->kategori_id = $request->kategori_id;
        $berita->created_at = $request->created_at;
        $berita->content = $request->content;

        $berita->save();
        return redirect()->route('berita.index');
    }

    public function edit($id){

        $berita = Berita::find($id);

        $kategoriList = Kategori::pluck('nama_kategori', 'id');
        return view('berita.edit', compact('berita', 'kategoriList'));
    }

    public function update(Request $request,$id){
        $berita = Berita::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'kategori_id' => 'required',
            'content' => 'required',
        ]);

        $berita->update([
            'title' => $request->title,
            'author' => $request->author,
            'kategori_id' => $request->kategori_id,
            'content' => $request->content,
        ]);

        return redirect()->route('berita.index', $berita->id)
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id){
        $berita  = Berita::find($id);
        $berita->delete();
        return redirect()->route('berita.index');
    }
}

