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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',
        ]);

        $comment = new Comment([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'comment' => $request->input('comment'),
        ]);

        $comment->save();

        // Menggunakan CommentResource untuk mengubah objek Comment menjadi respons JSON.
        $commentResource = new CommentResource($comment);

        return response()->json([
            'message' => 'Komentar berhasil disimpan',
            'data' => $commentResource,
        ], 201);
    }
}
