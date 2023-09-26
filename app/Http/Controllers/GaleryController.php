<?php

namespace App\Http\Controllers;

use App\Http\Resources\GaleryResource;
use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleryController extends Controller
{
    //API
    public function galery()
    {
        $galery = Galery::get();
        return GaleryResource::collection($galery);
        // return response()->json($galery);
    }


    //WEB
    public $table = "galerys";

    public function index()
    {
        return view('galery.index', [
            'galerys' => Galery::latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('galery.create');
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'image_galery' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            [
                'image_galery.required' => 'Kolom gambar harus di isi',
                'image_galery.image' => 'File yang diunggah harus berupa gambar',
                'image_galery.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
                'image_galery.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
            ]
        );
        if ($request->hasFile('image_galery')) {
            $image_galery = $request->file('image_galery');
            $namafile = time() . '.' . $image_galery->getClientOriginalExtension();
            $path = $image_galery->storeAs('images', $namafile); // Simpan gambar ke direktori penyimpanan

            $galery  = new Galery();

            // Setel atribut-atribut lainnya    
            $galery->image_galery = $path; // Gunakan path lengkap gambar

            $galery->save();

            return redirect()->route('galery.index')->with('success', 'Image Galery berhasil ditambahkan');
        } else {
            return back()->with('error', 'Gagal Menambah Galery.');
        }
    }

    public function edit($id)
    {

        $galery = Galery::find($id);
        return view('galery.edit', [
            'galery' => $galery,
        ]);
    }

    public function update(Request $request, $id)
    {
        $galery = Galery::find($id);

        $request->validate([
            'image_galery' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image_galery')) {
            // Hapus gambar lama jika ada
            if (Storage::disk('public')->exists($galery->image_galery)) {
                Storage::disk('public')->delete($galery->image_galery);
            }

            $image_galery = $request->file('image_galery');
            $namafile = time() . '.' . $image_galery->getClientOriginalExtension();
            $path = $image_galery->storeAs('images', $namafile, 'public'); // Simpan gambar ke direktori penyimpanan

            // Update gambar galery
            $galery->image_galery = $path;
        }
        $galery->save();

        return redirect()->route('galery.index')->with('success', 'Galery berhasil diperbarui');
    }

    public function destroy($id)
    {
        $galery = Galery::find($id);

        if (Storage::disk('public')->exists($galery->image_galery)) {
            // Hapus gambar dari penyimpanan jika ada
            Storage::disk('public')->delete($galery->image_galery);
        }

        // Hapus galery
        $galery->delete();

        return redirect()->route('galery.index')->with('success', 'Image Galery Berhasil Dihapus');
    }
}
