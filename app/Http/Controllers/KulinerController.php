<?php

namespace App\Http\Controllers;

use App\Http\Resources\KulinerResource;
use App\Models\Kuliner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KulinerController extends Controller
{
    //Api kuliner
    public function kuliner()
    {
        $kuliner = Kuliner::get();
        return KulinerResource::collection($kuliner);
    }

    public function show($id)
    {
        $show = Kuliner::findOrFail($id);
        return new KulinerResource($show);
    }

    public function cari(Request $request)
    {
        $kataKunci = $request->input('kata_kunci');
        $hasilPencarian = Kuliner::where('nama_kuliner', 'LIKE', "%$kataKunci%")->get();

        $hasilPencarianResource = KulinerResource::collection($hasilPencarian);
        return response()->json($hasilPencarianResource);
    }


    //Web
    public function index(Request $request)
    {
        $search = $request->input('search'); // Mengambil input pencarian dari form

        // Mulai dengan model Kuliner dan aplikasikan pengurutan terlebih dahulu.
        $query = Kuliner::latest();

        // Jika ada input pencarian, tambahkan kondisi pencarian ke query
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_kuliner', 'like', '%' . $search . '%')
                    ->orWhere('ket_kuliner', 'like', '%' . $search . '%');
            });
        }

        // Ambil data dengan pagination
        $kuliners = $query->paginate(10); // Ubah "get()" menjadi "paginate(10)"

        return view('kuliner.index', [
            'kuliners' => $kuliners,
            'search' => $search,
        ]);
    }


    public function create()
    {
        return view('kuliner.create');
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nama_kuliner' => ['required'],
                'alamat' => ['required'],
                'url_map' => ['required'],
                'ket_kuliner' => ['required'],
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            [
                'nama_kuliner.required' => 'Kolom nama kuliner harus di isi',
                'alamat.required' => 'Kolom alamat harus di isi',
                'url_map.required' => 'Kolom url harus di isi',
                'ket_kuliner.required' => 'Kolom keterangan kuliner harus di isi',
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

            $kuliner  = new Kuliner();

            // Setel atribut-atribut lainnya    
            $kuliner->nama_kuliner = $request->nama_kuliner;
            $kuliner->alamat = $request->alamat;
            $kuliner->url_map = $request->url_map;
            $kuliner->ket_kuliner = $request->ket_kuliner;
            $kuliner->image = $path; // Gunakan path lengkap gambar

            $kuliner->save();

            return redirect()->route('kuliner.index')->with('success', 'kuliner berhasil ditambahkan');
        } else {
            return back()->with('error', 'Gagal Menambah kuliner.');
        }
    }

    public function edit($id)
    {
        $kuliner = Kuliner::find($id);
        return view('kuliner.edit', [
            'kuliner' => $kuliner,
        ]);
    }

    public function update(Request $request, $id)
    {
        $kuliner = Kuliner::find($id);

        $request->validate([
            'nama_kuliner' => 'required',
            'alamat' => 'required',
            'url_map' => 'required',
            'ket_kuliner' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if (Storage::disk('public')->exists($kuliner->image)) {
                Storage::disk('public')->delete($kuliner->image);
            }

            $image = $request->file('image');
            $namafile = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images', $namafile, 'public'); // Simpan gambar ke direktori penyimpanan

            // Update gambar kuliner
            $kuliner->image = $path;
        }

        $kuliner->nama_kuliner = $request->nama_kuliner;
        $kuliner->alamat = $request->alamat;
        $kuliner->url_map = $request->url_map;
        $kuliner->ket_kuliner = $request->ket_kuliner;
        $kuliner->save();

        return redirect()->route('kuliner.index')->with('success', 'kuliner berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kuliner = Kuliner::find($id);

        if (Storage::disk('public')->exists($kuliner->image)) {
            // Hapus gambar dari penyimpanan jika ada
            Storage::disk('public')->delete($kuliner->image);
        }

        // Hapus kuliner
        $kuliner->delete();

        return redirect()->route('kuliner.index')->with('success', 'Kuliner Berhasil Dihapus');
    }
}
