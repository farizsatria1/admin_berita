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
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategoris as $index => $kategori)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kategori->nama_kategori }}</td>
                    <td>
                        <div class="btn-group ">
                            <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning mx-1">Edit</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
