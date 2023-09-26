@extends('templates.default')

@php
$title = "Berita Kab.Agam";
$preTitle = "Edit Data Wisata";
@endphp

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('wisata.update', $wisata->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Wisata</label>
                <input type="text" name="nama_wisata" class="form-control" value="{{$wisata->nama_wisata}}" placeholder="Masukkan Judul Wisata">
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{$wisata->alamat}}" placeholder="Masukan Alamat">
            </div>
            <div class="mb-3">
                <label class="form-label">URL Lokasi Wisata</label>
                <input type="text" name="url_map" class="form-control" value="{{$wisata->url_map}}" placeholder="Masukan URL Lokasi">
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar</label>
                @if ($wisata->image)
                <img id="preview" src="{{ asset('storage/' . $wisata->image) }}" alt="{{ $wisata->nama_wisata }}"  width="auto" height="100" style="margin-bottom: 0.5rem;">
                @else
                <p>Gambar tidak tersedia.</p>
                @endif
                <br>
                <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage(event, 'preview')">
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Keterangan</label>
                <textarea class="form-control" name="ket_wisata" rows="5" id="contentTextarea" placeholder="Keterangan">{{$wisata->ket_wisata}}"</textarea>
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