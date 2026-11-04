@extends('admin.layouts.app')
@section('title', 'Kelola Produk')
@section('subtitle', 'List seluruh produk di PPKD Sticker')
@section('content')
    <div align="right">
        <a href="{{ route('admin.product.create') }}" class="btn-table-action">
            <i class="bi bi-plus-circle-fill"></i> Tambah Produk
        </a>
    </div>
    <div class="table-responsive mt-1">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Kategori</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($item->image !== null)
                                <img src="{{ asset('storage/' . $item->image) }}" width="100" alt="{{ $item->name ?? '' }}">
                            @else
                                <span class="text-muted">Gambar tidak ditemukan</span>
                            @endif
                        </td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>Rp. {{ number_format($item->price, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
