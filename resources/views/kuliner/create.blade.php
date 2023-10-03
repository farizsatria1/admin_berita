@extends('templates.default')

@php
$title = "Berita Kab.Agam";
$preTitle = "Tambah Kuliner";
@endphp

@section('content')
<div class="card">
    <div class="card-body">
        <form action="/kuliner" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Kuliner</label>
                <input type="text" name="nama_kuliner" class="form-control 
                @error('nama_kuliner') 
                    is-invalid
                @enderror" placeholder="Masukkan Nama Kuliner" value="{{ old('nama_kuliner') }}">
                @error('nama_kuliner')
                <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Kuliner</label>
                <input type="text" name="alamat" class="form-control 
                @error('alamat') 
                    is-invalid
                @enderror" placeholder="Masukkan Alamat Kuliner" value="{{ old('alamat') }}">
                @error('alamat')
                <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">URL Lokasi Kuliner</label>
                <input type="text" name="url_map" class="form-control 
                @error('url_map') 
                    is-invalid
                @enderror" placeholder="Masukkan URL Lokasi Kuliner" value="{{ old('url_map') }}">
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
                <textarea name="ket_kuliner" rows="5" id="contentTextarea" class="form-control 
                @error('ket_kuliner') 
                is-invalid 
                @enderror" placeholder="Keterangan">{{ old('ket_kuliner') }}</textarea>
                @error('ket_kuliner')
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