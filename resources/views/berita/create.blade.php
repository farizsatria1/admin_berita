@extends('templates.default')

@php
$title = "Berita Kab.Agam";
$preTitle = "Daftar Berita";
@endphp

@section('content')
<div class="card">
    <div class="card-body">
        <form action="/berita" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="title" class="form-control 
                @error('title') 
                    is-invalid
                @enderror" placeholder="Masukkan Judul Berita" value="{{ old('title') }}">
                @error('title')
                <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Author</label>
                <input type="text" name="author" class="form-control
                @error('author') 
                    is-invalid
                @enderror" placeholder="Masukan Author" value="{{ old('author') }}">
                @error('author')
                <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select class="form-select
                @error('kategori_id') 
                    is-invalid
                @enderror" name="kategori_id">
                    <option value="">--Pilih Kategori--</option>
                    @foreach ($kategoriList as $id => $nama)
                    <option value="{{ $id }}">{{ $nama }}</option>
                    @endforeach
                </select>
                @error('kategori_id')
                <span class="invalid-feedback">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="created_at" class="form-control
                @error('created_at') 
                    is-invalid
                @enderror" placeholder="Masukan Tanggal" value="{{ old('created_at') }}" max="{{ date('Y-m-d') }}">
                @error('created_at')
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
                <label class="form-label">Isi Berita</label>
                <textarea name="content" rows="5" id="contentTextarea" class="form-control 
                @error('content') 
                is-invalid 
                @enderror" placeholder="Isi Berita">{{ old('content') }}</textarea>
                @error('content')
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