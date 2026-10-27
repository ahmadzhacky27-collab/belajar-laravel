@extend('belajar')
@section('content')
<form action="{{ route('actionTambah')}}" method="POST">
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
            <button type="submit">Tambahkan</button>
        </div>
    </form>
    <br>
    <h1>Hasilnya adalah {{ $jumlah ?? 0}}</h1>
@endsection
