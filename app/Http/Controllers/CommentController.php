<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $komen = Comment::all();
        return response()->json($komen);
    }

    public function getByBeritaId($berita_id)
    {
        // Mengambil komentar berdasarkan ID berita
        $komentar = Comment::where('berita_id', $berita_id)->get();
        return response()->json($komentar);
    }

    public function store(Request $request)
    {
        // Validasi input komentar
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'comment' => 'required|string',
            'berita_id' => 'required|integer',
        ]);

        // Simpan komentar baru
        $komentar = Comment::create($validatedData);

        return response()->json($komentar, 201); // 201 berarti Created
    }
}
