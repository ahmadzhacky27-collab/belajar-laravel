@extends('admin.layouts.app')
@section('title', 'Tambah Blog')
@section('subtitle', 'Buat blog baru dengan akses ke panel admin')

@section('content')
    <form action="{{ route('admin.blog.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="">Gambar</label>
            <input type="file" name="cover_path" class="form-control  ">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Kategori Blog</label>
            <select name="blog_category_id" class="form-select">
                <option value="">Pilih Kategori Blog</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Nama Blog</label>
            <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Slug (Opsional)</label>
            <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
            @error('slug')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Deskripsi Singkat (Opsional)</label>
            <input type="text" class="form-control" name="brief_description" value="{{ old('brief_description') }}">
            @error('brief_description')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Isi (Opsional)</label>
            <input type="text" class="form-control" name="content" value="{!! old('content') !!}">
            @error('content')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Author</label>
            <input type="text" class="form-control bg-light" name="author"
                value="{{ auth()->user()->name ?? 'Administrator' }}" readonly>
            @error('author')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn-custom btn-custom-primary">Simpan</button>
        <a href="{{ url()->previous() }}" class="btn-custom btn-custom-warning">Kembali</a>
    </form>
@endsection
