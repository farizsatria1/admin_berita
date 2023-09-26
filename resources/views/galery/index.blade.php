@extends('templates.default')

@php
$title = "Berita Kab.Agam";
$preTitle = "Galery";
@endphp

@push('page-action')
<a href="{{ route('galery.create') }}" class="btn btn-primary">+ Tambah Galery</a>
@endpush


@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter table-bordered">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="text-align: center;">Gambar</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($galerys as $index => $galery)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="text-align: center;">
                        @if ($galery->image_galery)
                        <img src="{{ asset('storage/' . $galery->image_galery) }}" alt="Gambat tidak ditemukan" width="100" style="display: block; margin: 0 auto;">
                        @else
                        Gambar tidak tersedia
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <div class="btn-group ">
                            <a href="{{ route('galery.edit', $galery->id) }}" class="btn btn-warning mx-1">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a class="btn btn-danger" onclick="DeleteGalery('{{ $galery->id }}')">
                                <i class="fa-solid fa-trash"></i>
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
    {{ $galerys->links('pagination::bootstrap-5') }}
</div>

@endsection