@extends('admin.layouts.app')
@section('title', 'Tambah Blog')
@section('subtitle', 'Buat blog baru dengan akses ke panel admin')

@section('content')
    <form action="{{ route('admin.blog.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="">Gambar</label>
            <input type="file" name="image[]" class="form-control">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Kategori Blog</label>
            <select name="category_id" class="form-select">
                <option value="">Pilih Kategori Blog</option>
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
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
        <button type="submit" class="btn-custom btn-custom-primary">Simpan</button>
        <a href="{{ url()->previous() }}" class="btn-custom btn-custom-warning">Kembali</a>
    </form>
@endsection
