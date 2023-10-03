@extends('templates.default')

@php
$title = "Berita Kab.Agam";
$preTitle = "Edit Galery";
@endphp

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('galery.update', $galery->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Gambar</label>
                @if ($galery->image_galery)
                <img id="preview" src="{{ asset('storage/' . $galery->image_galery) }}" alt="{{ $galery->nama_galery }}"  width="auto" height="100" style="margin-bottom: 0.5rem;">
                @else
                <p>Gambar tidak tersedia.</p>
                @endif
                <br>
                <input type="file" class="form-control-file" id="image_galery" name="image_galery" onchange="previewImage(event, 'preview')">
            </div>

            <div class="mb-4">
                <input type="submit" class="btn btn-primary" value="Simpan"></input>
            </div>
        </form>
    </div>
</div>
@endsection