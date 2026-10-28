@extends('admin.layouts.app')
@section('title', 'Tambah User')
@section('subtitle', 'Buat akun baru dengan akses ke panel admin')

@section('content')
    <form action="{{ route('admin.user.update', $user) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label-custom">Nama Lengkap *</label>
            <input type="text" class="form-control" name="name" required value="{{ old('name', $user->name) }}">
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Email *</label>
            <input type="text" class="form-control" name="email" required value="{{ old('email', $user->email) }}">
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Password Baru</label>
            <input type="password" class="form-control" name="password">
            <div class="form-text">
                <small>Kosongkan jika tidak ingin mengubah password.</small>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn-custom btn-custom-primary">Simpan</button>
    </form>
@endsection
