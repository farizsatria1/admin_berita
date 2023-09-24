@extends('templates.default')

@php
$title = "Berita Kab.Agam";
$preTitle = "Daftar Kategori";
@endphp

@push('page-action')
<a href="{{ route('kategori.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
@endpush


@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter table-bordered">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="text-align: center;">Nama Kategori</th>
                    <th style="text-align: center;">Gambar Kategori</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategoris as $index => $kategori)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kategori->nama_kategori }}</td>
                    <td style="text-align: center;">
                        @if ($kategori->image_kategori)
                        <img src="{{ asset('storage/' . $kategori->image_kategori) }}" alt="{{ $kategori->title }}" width="150" style="display: block; margin: 0 auto;">
                        @else
                        Gambar tidak tersedia
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <div class="btn-group ">
                            <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning mx-1">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<br>
<div class="text-center">
    {{ $kategoris->links('pagination::bootstrap-5') }}
</div>

@endsection