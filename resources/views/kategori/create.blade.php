@extends('templates.default')

@php
$title = "Berita Kab.Agam";
$preTitle = "Tambah Kategori";
@endphp

@section('content')
<div class="card">
    <div class="card-body">
        <form action="/kategori" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tambah Kategori</label>
                <input type="text" name="nama_kategori" class="form-control 
                @error('nama_kategori') 
                    is-invalid
                @enderror" placeholder="Masukkan Kategori Berita">
                @error('nama_kategori')
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