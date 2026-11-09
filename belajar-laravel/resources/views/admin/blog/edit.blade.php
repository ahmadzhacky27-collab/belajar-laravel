@extends('admin.layouts.app')
@section('title', 'Edit Blog')
@section('subtitle', 'Perbarui blog')

@section('content')
    <form action="{{ route('admin.blog.update', $Blog->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label-custom">Nama Blog</label>
            <input type="text" class="form-control" name="name" required value="{{ old('name', $Blog->name) }}">
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Slug (Opsional)</label>
            <input type="text" class="form-control" name="slug" value="{{ old('slug', $Blog->slug) }}">
            @error('slug')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn-custom btn-custom-primary">Simpan</button>
        <a href="{{ url()->previous() }}" class="btn-custom btn-custom-warning">Kembali</a>
    </form>
@endsection
