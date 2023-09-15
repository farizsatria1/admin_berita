@extends('templates.default')

@php
$title = "Berita Kab.Agam";
$preTitle = "Edit Kategori";
@endphp

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Edit Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" value="{{$kategori->nama_kategori}}" placeholder="Masukkan Kategori Berita">
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar</label>
                @if ($kategori->image_kategori)
                <img id="preview" src="{{ asset('storage/' . $kategori->image_kategori) }}" alt="{{ $kategori->nama_kategori }}"  width="auto" height="100" style="margin-bottom: 0.5rem;">
                @else
                <p>Gambar tidak tersedia.</p>
                @endif
                <br>
                <input type="file" class="form-control-file" id="image_kategori" name="image_kategori" onchange="previewImage(event, 'preview')">
            </div>

            <div class="mb-4">
                <input type="submit" class="btn btn-primary" value="Simpan"></input>
            </div>
        </form>
    </div>
</div>
@endsection