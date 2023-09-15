@extends('templates.default')

@php
$title = "Berita Kab.Agam";
$preTitle = "Edit Video";
@endphp

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('video.update', $video->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Edit Judul Video</label>
                <input type="text" name="title" class="form-control" value="{{$video->title}}" placeholder="Masukkan Judul Video">
            </div>

            <div class="mb-3">
                <label class="form-label">Edit Link Video</label>
                <input type="text" name="youtube_url" class="form-control" value="{{$video->youtube_url}}" placeholder="Masukkan Link Video">
            </div>

            <div class="mb-4">
                <input type="submit" class="btn btn-primary" value="Simpan"></input>
            </div>
        </form>
    </div>
</div>
@endsection