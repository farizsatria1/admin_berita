@extends('templates.default')

@php
$title = "Berita Kab.Agam";
$preTitle = "Daftar Video";
@endphp

@push('page-action')
<a href="{{ route('video.create') }}" class="btn btn-primary">+ Tambah Video</a>
@endpush


@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter table-bordered">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="text-align: center;">Judul Video</th>
                    <th style="text-align: center;">Link Video</th>
                    <th style="width: 20%; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videos as $index => $video)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $video->title }}</td>
                    <td>{{ $video->youtube_url }}</td>         
                    <td style="text-align: center;">
                        <a href="{{ route('video.edit', $video->id) }}" class="btn btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a class="btn btn-danger" onclick="Delete('{{ $video->id }}')">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection