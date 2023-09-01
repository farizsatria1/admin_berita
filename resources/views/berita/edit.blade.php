@extends('templates.default')

@php
$title = "Berita Kab.Agam";
$preTitle = "Edit Data Berita";
@endphp

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('berita.update', $berita->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="title" class="form-control" value="{{$berita->title}}" placeholder="Masukkan Judul Berita">
            </div>
            <div class="mb-3">
                <label class="form-label">Author</label>
                <input type="text" name="author" class="form-control" value="{{$berita->author}}" placeholder="Masukan Author">
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select class="form-select" name="kategori_id">
                    @foreach ($kategoriList as $id => $nama)
                    <option value="">--Pilih Kategori--</option>
                    <option value="{{ $id }}" {{ $berita->kategori_id == $id ? 'selected' : '' }}>{{ $nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Berita</label>
                <textarea class="form-control" name="content" rows="5" id="contentTextarea" placeholder="Isi Berita">{{$berita->content}}"</textarea>
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