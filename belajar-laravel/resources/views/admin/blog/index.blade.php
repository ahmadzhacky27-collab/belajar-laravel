@extends('admin.layouts.app')
@section('title', 'Managemen Blog')
@section('subtitle', 'Pengelompokan blog')

@section('content')
    <div class="mb-3" align="right">
        <a href="{{ route('admin.blog.create') }}" class="btn btn-table-action">
            <i class="bi bi-person-add"></i> Tambah Blog
        </a>
    </div>
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cover</th>
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>Slug Url</th>
                    <th>Deskripsi Singkat</th>
                    <th>Penulis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $key => $data)
                    <tr>
                        <td>{{ $key += 1 }}</td>
                        <td><img src="{{ asset('storage/' . $data->cover_path ?? '') }}" alt=""></td>
                        <td>{{ $data->category->name ?? '' }}</td>
                        <td>{{ $data->name ?? '' }}</td>
                        <td>{{ $data->slug ?? '' }}</td>
                        <td>{{ $data->brief_description ?? '' }}</td>
                        <td>
                            <a class="table-btn-action" title="Edit" href="{{ route('admin.blog.edit', $data->id) }}">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('admin.blog.destroy', $data->id) }}" method="post" class="d-inline"
                                onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="table-btn-action delete" title="Delete" type="submit">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
