@extends('templates.default')

@php
$title = "Berita Kab.Agam";
$preTitle = "Tambah Video";
@endphp

@section('content')
<div class="card">
    <div class="card-body">
        <form action="/video" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tambah Judul Video</label>
                <input type="text" name="title" class="form-control 
                @error('title') 
                    is-invalid
                @enderror" placeholder="Masukkan Judul Video" value="{{ old('title') }}">
                @error('title')
                <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Tambah Link Video</label>
                <input type="text" name="youtube_url" class="form-control 
                @error('youtube_url') 
                    is-invalid
                @enderror" placeholder="Masukkan Link Video" value="{{ old('youtube_url') }}">
                @error('youtube_url')
                <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-4">
                <input type="submit" class="btn btn-primary" value="Simpan"></input>
            </div>
        </form>
    </div>
</div>
@endsection