@extends('templates.default')

@php
$title = "Berita Kab.Agam";
$preTitle = "Edit Data Kuliner";
@endphp

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('kuliner.update', $kuliner->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Kuliner</label>
                <input type="text" name="nama_kuliner" class="form-control" value="{{$kuliner->nama_kuliner}}" placeholder="Masukkan Judul Kuliner">
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{$kuliner->alamat}}" placeholder="Masukan Alamat">
            </div>
            <div class="mb-3">
                <label class="form-label">URL Lokasi Kuliner</label>
                <input type="text" name="url_map" class="form-control" value="{{$kuliner->url_map}}" placeholder="Masukan URL Lokasi">
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar</label>
                @if ($kuliner->image)
                <img id="preview" src="{{ asset('storage/' . $kuliner->image) }}" alt="{{ $kuliner->nama_kuliner }}"  width="auto" height="100" style="margin-bottom: 0.5rem;">
                @else
                <p>Gambar tidak tersedia.</p>
                @endif
                <br>
                <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage(event, 'preview')">
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Keterangan</label>
                <textarea class="form-control" name="ket_kuliner" rows="5" id="contentTextarea" placeholder="Keterangan">{{$kuliner->ket_kuliner}}"</textarea>
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