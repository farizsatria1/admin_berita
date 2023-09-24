<?php

namespace App\Http\Controllers;

use App\Http\Resources\BeritaDetailresource;
use App\Http\Resources\BeritaResource;
use App\Http\Resources\KategoriResource;
use App\Http\Resources\ListKategoriResource;
use App\Models\Berita;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public $table = "beritas";

    //Api Berita
    public function berita()
    {
        $berita = Berita::with('kategori:id,nama_kategori,image_kategori')->get();
        return BeritaResource::collection($berita);
    }

    public function show($id)
    {
        $show = Berita::with('kategori:id,nama_kategori')->findOrFail($id);
        return new BeritaDetailResource($show);
    }

    public function listkategori()
    {
        $kategori = Kategori::get();
        return ListKategoriResource::collection($kategori);
    }

    public function kategori($id)
    {
        $kategori = Berita::whereHas('kategori', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();

        return KategoriResource::collection($kategori);
    }

    public function cari(Request $request)
    {
        $kataKunci = $request->input('kata_kunci');
        $hasilPencarian = Berita::where('title', 'LIKE', "%$kataKunci%")->get();

        // Mengubah hasil pencarian ke BeritaResource
        $hasilPencarianResource = BeritaResource::collection($hasilPencarian);

        return response()->json($hasilPencarianResource);
    }




    // Fungsi untuk Web

    public function index(Request $request)
    {
        $search = $request->input('search'); // Mengambil input pencarian dari form

        // Menggunakan query builder untuk menggabungkan tabel Berita dengan tabel Kategori
        $query = Berita::with('kategori');

        // Jika ada input pencarian, tambahkan kondisi pencarian ke query
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        // Ambil data dengan pagination
        $beritas = $query->latest()->paginate(10); // Ubah "get()" menjadi "paginate(10)"

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

            return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
        } else {
            return back()->with('error', 'Berita Gagal ditambahkan.');
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

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if (Storage::disk('public')->exists($berita->image)) {
                Storage::disk('public')->delete($berita->image);
            }

            $image = $request->file('image');
            $namafile = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images', $namafile, 'public'); // Simpan gambar ke direktori penyimpanan

            // Update gambar berita
            $berita->image = $path;
        }

        $berita->title = $request->title;
        $berita->author = $request->author;
        $berita->kategori_id = $request->kategori_id;
        $berita->content = $request->content;
        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
    }


    public function destroy($id)
    {
        $berita = Berita::find($id);

        // Hapus semua komentar terkait
        $berita->comments()->delete();

        // Hapus berita
        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita Berhasil Dihapus');
    }
}
