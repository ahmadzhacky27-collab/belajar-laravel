<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Belajar Laravel' }}</title>
</head>

<body>
    <h1>Belajar Matematika Dasar</h1>
    <a href="{{ route('tambah') }}">Pertambahan</a>
    <a href="{{ route('kurang') }}">Pengurangan</a>
    <a href="{{ route('kali') }}">Perkalian</a>
    <a href="{{ route('bagi') }}">Pembagian</a>

    <a href="{{ url()->previous() }}">Kembali</a>

    <form action="{{ route('actionKurang')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Angka 1</label>
            <input type="number" name="angka1" placeholder="Masukan angka">
        </div>
        <br>
        <div class="form-group">
            <label for="">Angka 2</label>
            <input type="number" name="angka2" placeholder="Masukan angka">
        </div>
        <br>
        <div class="form-group">
            <button type="submit">Kurangkan</button>
        </div>
    </form>
    <br>
    <h1>Hasilnya adalah {{ $jumlah ?? 0}}</h1>
</body>

</html>
