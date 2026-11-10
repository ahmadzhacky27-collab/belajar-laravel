@extends('admin.layouts.app')
@section('title', 'Edit Blog')
@section('subtitle', 'Perbarui blog')

@section('content')
    <form action="{{ route('admin.blog.update', $blog->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="">Gambar</label>
            @if($blog->cover_path)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $blog->cover_path) }}" alt="Cover" width="100" class="img-thumbnail">
                </div>
            @endif
            <input type="file" name="cover_path" class="form-control">
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Kategori Blog</label>
            <select name="blog_category_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('blog_category_id', $blog->blog_category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('blog_category_id')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Nama Blog</label>
            <input type="text" class="form-control" name="name" required value="{{ old('name', $blog->name) }}">
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Slug (Opsional)</label>
            <input type="text" class="form-control" name="slug" value="{{ old('slug', $blog->slug) }}">
            @error('slug')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Deskripsi Singkat (Opsional)</label>
            <input type="text" class="form-control" name="brief_description" value="{{ old('brief_description', $blog->brief_description) }}">
            @error('brief_description')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Isi (Opsional)</label>
            <input type="text" class="form-control" name="content" value="{{ old('content', $blog->content) }}">
            @error('content')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Author</label>
            <input type="text" class="form-control bg-light" name="author"
                value="{{ old('author', $blog->author ?? auth()->user()->name) }}" readonly>
            @error('author')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn-custom btn-custom-primary">Simpan</button>
        <a href="{{ url()->previous() }}" class="btn-custom btn-custom-warning">Kembali</a>
    </form>
@endsection
