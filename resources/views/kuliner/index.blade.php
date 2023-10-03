@extends('templates.default')

@section('title', 'Berita Kab.Agam')
@section('preTitle', 'Daftar Kuliner')

@push('page-action')
<div class="input-group mb-3">
    <form action="{{ route('kuliner.index') }}" method="GET" class="w-100">
        <div class="input-group">
            <input type="text" name="search" class="form-control me-2" placeholder="Search…" value="{{ request('search') }}">
            <button type="submit" class="btn btn-warning">
                <i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i> 
            </button>
        </div>
    </form>
</div>

<a href="{{ route('kuliner.create') }}" class="btn btn-primary">+ Tambah Data</a>
@endpush

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">Nama Kuliner</th>
                    <th style="text-align: center;">Gambar</th>
                    <th style="text-align: center;">Alamat</th>
                    <th style="text-align: center;">URL Lokasi</th>
                    <th style="text-align: center;">Keterangan</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kuliners as $index => $kuliner)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kuliner->nama_kuliner }}</td>
                    <td style="text-align: center;">
                        @if ($kuliner->image)
                        <img src="{{ asset('storage/' . $kuliner->image) }}" alt="{{ $kuliner->nama_kuliner }}" width="100" style="display: block; margin: 0 auto;">
                        @else
                        Gambar tidak tersedia
                        @endif
                    </td>
                    <td>{{ $kuliner->alamat }}</td>
                    <td>{{ $kuliner->url_map }}</td>
                    <td>{{ Str::limit($kuliner->ket_kuliner, 200) }}</td>
                    <td style="text-align: center;">
                        <a href="{{ route('kuliner.edit', $kuliner->id) }}" class="btn btn-warning mb-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a class="btn btn-danger" onclick="DeleteKuliner('{{ $kuliner->id }}')">
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
    {{ $kuliners->links('pagination::bootstrap-5') }}
</div>

@endsection