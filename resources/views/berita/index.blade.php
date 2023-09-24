@extends('templates.default')

@section('title', 'Berita Kab.Agam')
@section('preTitle', 'Daftar Berita')

@push('page-action')
<div class="input-icon mb-3">
    <form action="{{ route('berita.index') }}" method="GET">
        <input type="text" name="search" class="form-control" placeholder="Search…" value="{{ request('search') }}">
        <span class="input-icon-addon">
        </span>
        <button type="submit" style="display: none;"></button>
    </form>
</div>

<a href="{{ route('berita.create') }}" class="btn btn-primary">+ Tambah Data</a>
@endpush

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th style="width: 15%; text-align: center;">Judul</th>
                    <th style="text-align: center;">Author</th>
                    <th style="text-align: center;">Kategori</th>
                    <th style="text-align: center;">Gambar</th>
                    <th style="text-align: center;">Isi Berita</th>
                    <th style="text-align: center;">Tanggal</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($beritas as $index => $berita)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $berita->title }}</td>
                    <td>{{ $berita->author }}</td>
                    <td>{{ $berita->kategori->nama_kategori }}</td>
                    <td style="text-align: center;">
                        @if ($berita->image)
                        <img src="{{ asset('storage/' . $berita->image) }}" alt="{{ $berita->title }}" width="100" style="display: block; margin: 0 auto;">
                        @else
                        Gambar tidak tersedia
                        @endif
                    </td>
                    <td>{{ Str::limit($berita->content, 300) }}</td>
                    <td style="text-align: center;">{{ $berita->created_at->format('d M Y H:i:s') }}</td>

                    <td style="text-align: center;">
                        <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-warning mb-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a class="btn btn-danger" onclick="confirmDelete('{{ $berita->id }}')">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Tambahkan navigasi halaman di bagian bawah tabel -->
<br>
<div class="text-center">
    {{ $beritas->links('pagination::bootstrap-5') }}
</div>

@endsection