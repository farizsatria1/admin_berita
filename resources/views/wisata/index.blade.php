@extends('templates.default')

@section('title', 'Berita Kab.Agam')
@section('preTitle', 'Daftar Wisata')

@push('page-action')
<div class="input-group mb-3">
    <form action="{{ route('wisata.index') }}" method="GET" class="w-100">
        <input type="text" name="search" class="form-control" placeholder="Search…" value="{{ request('search') }}">
        <div class="input-group-append">
            <button type="submit" class="btn btn-warning">
                <i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i> 
            </button>
        </div>
    </form>
</div>


<a href="{{ route('wisata.create') }}" class="btn btn-primary">+ Tambah Data</a>
@endpush

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">Nama Wisata</th>
                    <th style="text-align: center;">Gambar</th>
                    <th style="text-align: center;">Alamat</th>
                    <th style="text-align: center;">URL Lokasi</th>
                    <th style="text-align: center;">Keterangan</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($wisatas as $index => $wisata)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $wisata->nama_wisata }}</td>
                    <td style="text-align: center;">
                        @if ($wisata->image)
                        <img src="{{ asset('storage/' . $wisata->image) }}" alt="{{ $wisata->nama_wisata }}" width="100" style="display: block; margin: 0 auto;">
                        @else
                        Gambar tidak tersedia
                        @endif
                    </td>
                    <td>{{ $wisata->alamat }}</td>
                    <td>{{ $wisata->url_map }}</td>
                    <td>{{ Str::limit($wisata->ket_wisata, 200) }}</td>
                    <td style="text-align: center;">
                        <a href="{{ route('wisata.edit', $wisata->id) }}" class="btn btn-warning mb-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a class="btn btn-danger" onclick="DeleteWisata('{{ $wisata->id }}')">
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
    {{ $wisatas->links('pagination::bootstrap-5') }}
</div>

@endsection