<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    public $table = "kategoris";

    public function index()
    {
        return view('kategori.index', [
            'kategoris' => Kategori::latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nama_kategori' => ['required'],
                'image_kategori' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            [
                'nama_kategori.required' => 'Kolom Kategori harus di isi',
                'image_kategori.required' => 'Kolom gambar harus di isi',
                'image_kategori.image' => 'File yang diunggah harus berupa gambar',
                'image_kategori.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
                'image_kategori.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
            ]
        );
        if ($request->hasFile('image_kategori')) {
            $image_kategori = $request->file('image_kategori');
            $namafile = time() . '.' . $image_kategori->getClientOriginalExtension();
            $path = $image_kategori->storeAs('images', $namafile); // Simpan gambar ke direktori penyimpanan

            $kategori  = new Kategori();

            // Setel atribut-atribut lainnya    
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->image_kategori = $path; // Gunakan path lengkap gambar

            $kategori->save();

            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
        } else {
            return back()->with('error', 'Gagal Menambah Kategori.');
        }
    }

    public function edit($id)
    {

        $kategori = Kategori::find($id);
        return view('kategori.edit', [
            'kategori' => $kategori,
        ]);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);

        $request->validate([
            'nama_kategori' => 'required',
            'image_kategori' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image_kategori')) {
            // Hapus gambar lama jika ada
            if (Storage::disk('public')->exists($kategori->image_kategori)) {
                Storage::disk('public')->delete($kategori->image_kategori);
            }

            $image_kategori = $request->file('image_kategori');
            $namafile = time() . '.' . $image_kategori->getClientOriginalExtension();
            $path = $image_kategori->storeAs('images', $namafile, 'public'); // Simpan gambar ke direktori penyimpanan

            // Update gambar kategori
            $kategori->image_kategori = $path;
        }

        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }
}
