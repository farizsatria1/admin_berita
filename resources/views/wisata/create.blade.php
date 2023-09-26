@extends('templates.default')

@php
$title = "Berita Kab.Agam";
$preTitle = "Tambah Wisata";
@endphp

@section('content')
<div class="card">
    <div class="card-body">
        <form action="/wisata" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Wisata</label>
                <input type="text" name="nama_wisata" class="form-control 
                @error('nama_wisata') 
                    is-invalid
                @enderror" placeholder="Masukkan Nama Wisata" value="{{ old('nama_wisata') }}">
                @error('nama_wisata')
                <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Wisata</label>
                <input type="text" name="alamat" class="form-control 
                @error('alamat') 
                    is-invalid
                @enderror" placeholder="Masukkan Alamat Wisata" value="{{ old('alamat') }}">
                @error('alamat')
                <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">URL Lokasi Wisata</label>
                <input type="text" name="url_map" class="form-control 
                @error('url_map') 
                    is-invalid
                @enderror" placeholder="Masukkan URL Lokasi Wisata" value="{{ old('url_map') }}">
                @error('url_map')
                <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-label">Masukan Gambar</div>
                <input type="file" class="form-control 
                @error('image') 
                    is-invalid
                @enderror" name="image">
                @error('image')
                <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="ket_wisata" rows="5" id="contentTextarea" class="form-control 
                @error('ket_wisata') 
                is-invalid 
                @enderror" placeholder="Keterangan">{{ old('ket_wisata') }}</textarea>
                @error('ket_wisata')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-4">
                <input type="submit" class="btn btn-primary" value="Simpan"></input>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("input", function() {
        const textarea = document.getElementById("contentTextarea");
        textarea.style.height = "auto";
        textarea.style.height = (textarea.scrollHeight) + "px";
    });
</script>
@endsection