<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    //API Video
    public function list()
    {
        $videos = Video::all();
        return response()->json($videos);
    }



    //Untuk Web
    public $table = "videos";

    public function index()
    {
        return view('video.index', [
            'videos' => Video::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('video.create');
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => ['required'],
                'youtube_url' => ['required'],
            ],
            [
                'title.required' => 'Kolom title harus di isi',
                'youtube_url.required' => 'Kolom url harus di isi',

            ]
        );
        $video  = new Video();
        $video->title = $request->title;
        $video->youtube_url = $request->youtube_url;
        $video->save();
        return redirect()->route('video.index')->with('success', 'Video berhasil ditambahkan');
    }

    public function edit($id)
    {
        $video = Video::find($id);
        return view('video.edit', [
            'video' => $video,
        ]);
    }

    public function update(Request $request, $id)
    {
        $video  = Video::find($id);

        $request->validate([
            'title' => 'required',
            'youtube_url' => 'required',
        ]);

        $video->update([
            'title' => $request->title,
            'youtube_url' => $request->youtube_url,
        ]);
        $video->save();
        return redirect()->route('video.index')->with('success', 'Video berhasil diperbarui');
    }

    public function destroy($id)
    {
        $video  = Video::find($id);
        $video->delete();
        return redirect()->route('video.index')->with('success', 'Video Berhasil Dihapus');
    }
}
