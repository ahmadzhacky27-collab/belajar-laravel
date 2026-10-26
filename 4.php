<?php
// class : blueprint untuk mengahasilkan sebuah object
// property : { nama: joko }
// variable di dalam class
// method/function :
// object/instance :
class Siswa {
    public $nama;
    public $nik;
    public $jurusan;
    public $nilai;

    public function __construct($nama, $nik, $jurusan, $nilai){
        $this->nama = $nama;
        $this->nik = $nik;
        $this->jurusan = $jurusan;
        $this->nilai = $nilai;

        echo "Selamat Datang {$this->nama} ({$this->nik}) <br>";
    }

    public function callName()
        {
            return $this->nama;
        }
        
        public function getNik()
        {
            return $this->nik;
        }
}

$siswa = new Siswa("Agung Sedayu", "2026102601", "Web Programming", 100);
$siswa = new Siswa("Jagung Seganteng", "2026102601", "Web Programming", 50);

echo "Nama :" . $siswa->nama . "<br>";
echo "Nik :" . $siswa->nik . "<br>";
echo "Jurusan :" . $siswa->jurusan . "<br>";
echo "Nilai :" . $siswa->nilai . "<br>";