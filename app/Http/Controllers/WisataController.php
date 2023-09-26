<?php

namespace App\Http\Controllers;

use App\Http\Resources\WisataResource;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    //Api Wisata
    public function wisata()
    {
        $wisata = Wisata::get();
        return WisataResource::collection($wisata);
    }

    public function show($id)
    {
        $show = Wisata::findOrFail($id);
        return new WisataResource($show);
    }


    //Web
    public function index(Request $request)
    {
        $search = $request->input('search'); // Mengambil input pencarian dari form

        // Mulai dengan model Wisata dan aplikasikan pengurutan terlebih dahulu.
        $query = Wisata::latest();

        // Jika ada input pencarian, tambahkan kondisi pencarian ke query
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_wisata', 'like', '%' . $search . '%')
                    ->orWhere('ket_wisata', 'like', '%' . $search . '%');
            });
        }

        // Ambil data dengan pagination
        $wisatas = $query->paginate(10); // Ubah "get()" menjadi "paginate(10)"

        return view('wisata.index', [
            'wisatas' => $wisatas,
            'search' => $search,
        ]);
    }


    public function create()
    {
        return view('wisata.create');
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nama_wisata' => ['required'],
                'alamat' => ['required'],
                'url_map' => ['required'],
                'ket_wisata' => ['required'],
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            [
                'nama_wisata.required' => 'Kolom nama wisata harus di isi',
                'alamat.required' => 'Kolom alamat harus di isi',
                'url_map.required' => 'Kolom url harus di isi',
                'ket_wisata.required' => 'Kolom keterangan wisata harus di isi',
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

            $wisata  = new Wisata();

            // Setel atribut-atribut lainnya    
            $wisata->nama_wisata = $request->nama_wisata;
            $wisata->alamat = $request->alamat;
            $wisata->url_map = $request->url_map;
            $wisata->ket_wisata = $request->ket_wisata;
            $wisata->image = $path; // Gunakan path lengkap gambar

            $wisata->save();

            return redirect()->route('wisata.index')->with('success', 'Wisata berhasil ditambahkan');
        } else {
            return back()->with('error', 'Gagal Menambah wisata.');
        }
    }

    public function edit($id)
    {
        $wisata = Wisata::find($id);
        return view('wisata.edit', [
            'wisata' => $wisata,
        ]);
    }

    public function update(Request $request, $id)
    {
        $wisata = Wisata::find($id);

        $request->validate([
            'nama_wisata' => 'required',
            'alamat' => 'required',
            'url_map' => 'required',
            'ket_wisata' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if (Storage::disk('public')->exists($wisata->image)) {
                Storage::disk('public')->delete($wisata->image);
            }

            $image = $request->file('image');
            $namafile = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images', $namafile, 'public'); // Simpan gambar ke direktori penyimpanan

            // Update gambar wisata
            $wisata->image = $path;
        }

        $wisata->nama_wisata = $request->nama_wisata;
        $wisata->alamat = $request->alamat;
        $wisata->url_map = $request->url_map;
        $wisata->ket_wisata = $request->ket_wisata;
        $wisata->save();

        return redirect()->route('wisata.index')->with('success', 'wisata berhasil diperbarui');
    }

    public function destroy($id)
    {
        $wisata = Wisata::find($id);

        if (Storage::disk('public')->exists($wisata->image)) {
            // Hapus gambar dari penyimpanan jika ada
            Storage::disk('public')->delete($wisata->image);
        }

        // Hapus wisata
        $wisata->delete();

        return redirect()->route('wisata.index')->with('success', 'Wisata Berhasil Dihapus');
    }
}
