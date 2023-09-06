<?php

namespace App\Http\Controllers;

use App\Http\Resources\BeritaResource;
use App\Models\Berita;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public $table = "beritas";

    //Api Berita
    public function berita(){
        $berita = Berita::all();

        $res = [];
        foreach ($berita as $value) {
            $data = [
                "id" => $value->id,
                "title" => $value->title,
                "author" => $value->author,
                "content" => $value->content,
                "image" =>Storage::url($value->image),
                "kategori_id" => $value->kategori_id,
                "created_at" => Carbon::parse($value->created_at)->format('Y-m-d H:i:s'),
            ];
            $res[] = $data;
        }
        // return response()->json($res);
        return response()->json(['data' => $res]);
        // return BeritaResource::collection($res);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Berita::with('kategori');
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $beritas = $query->latest()->get();

        return view('berita.index', [
            'beritas' => $beritas,
            'search' => $search,
        ]);
    }


    public function create()
    {
        $kategoriList = Kategori::pluck('nama_kategori', 'id');
        return view('berita.create', compact('kategoriList'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => ['required'],
                'author' => ['required'],
                'kategori_id' => ['required'],
                'created_at' => ['required'],
                'content' => ['required'],
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            [
                'title.required' => 'Kolom judul harus di isi',
                'author.required' => 'Kolom author harus di isi',
                'kategori_id.required' => 'Kolom kategori harus di isi',
                'created_at.required' => 'Kolom tanggal harus di isi',
                'content.required' => 'Kolom berita harus di isi',
                'image.required' => 'Kolom gambar harus di isi',
                'image.image' => 'File yang diunggah harus berupa gambar',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
                'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
            ]
        );

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $namafile = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images', $namafile); // Simpan gambar ke direktori penyimpanan
        
            $berita = new Berita();
        
            // Setel atribut-atribut lainnya    
            $berita->title = $request->title;
            $berita->author = $request->author;
            $berita->kategori_id = $request->kategori_id;
            $berita->image = $path; // Gunakan path lengkap gambar
            $berita->created_at = $request->created_at;
            $berita->content = $request->content;
        
            $berita->save();
        
            // Buat URL gambar dengan perintah yang diberikan
            $gambarURL = Storage::url($path); // Menggunakan Storage::url()
        
            return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan. URL gambar: ' . $gambarURL);
        } else {
            return back()->with('error', 'Gagal mengunggah gambar.');
        }
        
    }

    public function edit($id)
    {

        $berita = Berita::find($id);

        $kategoriList = Kategori::pluck('nama_kategori', 'id');
        return view('berita.edit', compact('berita', 'kategoriList'));
    }

    public function update(Request $request, $id)
    {

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
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'content' => $request->content,
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $namafile = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images', $namafile); // Simpan gambar ke direktori penyimpanan

            // Hapus gambar lama jika ada
            Storage::delete($berita->image);

            // Update gambar berita
            $berita->image = $path;
            $berita->save();

            // Buat URL gambar dengan perintah yang diberikan
            $gambarURL = url('/') . Storage::url('public/images') . '/' . $namafile;

            return redirect()->route('berita.index')->with('success', 'Gambar berita berhasil diperbarui. URL gambar: ' . $gambarURL);
        } else {
            return back()->with('error', 'Gagal mengunggah gambar.');
        }
    }

    public function destroy($id)
    {
        $berita  = Berita::find($id);
        $berita->delete();
        return redirect()->route('berita.index');
    }
}
