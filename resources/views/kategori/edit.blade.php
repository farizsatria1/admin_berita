@extends('templates.default')

@php
$title = "Berita Kab.Agam";
$preTitle = "Edit Kategori";
@endphp

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Edit Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" value="{{$kategori->nama_kategori}}" placeholder="Masukkan Kategori Berita">
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