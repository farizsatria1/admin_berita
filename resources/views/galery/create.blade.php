@extends('templates.default')

@php
$title = "Berita Kab.Agam";
$preTitle = "Galery";
@endphp

@section('content')
<div class="card">
    <div class="card-body">
        <form action="/galery" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <div class="form-label">Tambahkan Gambar</div>
                <input type="file" class="form-control 
                @error('image_galery') 
                    is-invalid
                @enderror" name="image_galery">
                @error('image_galery')
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