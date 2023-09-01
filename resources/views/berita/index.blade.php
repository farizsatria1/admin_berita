@extends('templates.default')

@php
    $title = "Berita Kab.Agam";
    $preTitle = "Daftar Berita";
@endphp

@push('page-action')
<a href="{{ route('berita.create') }}" class="btn btn-primary">+ Tambah Data</a>
@endpush


@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="width: 15%;">Judul</th>
                    <th style="width: 10%;">Author</th>
                    <th>Kategori</th>
                    <th style="text-align: center;">Isi Berita</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($beritas as $index => $berita)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $berita->title }}</td>
                    <td>{{ $berita->author }}</td>
                    <td>{{ $berita->kategori->nama_kategori }}</td>
                    <td>{{ $berita->content }}</td>
                    <td>{{ $berita->created_at }}</td>
                    <td>
                        <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-warning mb-1 btn-sm">Edit</a>
                        <form action="{{ route('berita.destroy', $berita->id) }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
