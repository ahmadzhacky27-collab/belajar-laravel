<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BelajarController extends Controller
{
    public function index()
    {
        $title = "Belajar Laravel Asyik Asyik";
        return view('belajar', compact('title'));
    }

    public function tambah()
    {
        $title = "Tambah-tambahan";
        return view('tambah', compact('title'));
    }

    public function actionTambah(Request $request)
    {
        $angka1 = $request->angka1;
        $angka2 = $request->input('angka2');
        $jumlah = $angka1 + $angka2;
        // return $jumlah;
        $title = 'Hasil Penambahan';
        return view('tambah', compact('jumlah', 'title'));
    }

    public function kurang()
    {
        $title = "Pengurangan";
        return view('kurang', compact('title'));
    }

    public function actionKurang(Request $request)
    {
        $angka1 = $request->angka1;
        $angka2 = $request->input('angka2');
        $jumlah = $angka1 - $angka2;
        // return $jumlah;
        $title = 'Hasil Pengurangan';
        return view('kurang', compact('jumlah', 'title'));
    }

    public function kali()
    {
        $title = "Perkalian";
        return view('kali', compact('title'));
    }

    public function actionKali(Request $request)
    {
        $angka1 = $request->angka1;
        $angka2 = $request->input('angka2');
        $jumlah = $angka1 * $angka2;
        // return $jumlah;
        $title = 'Hasil Perkalian';
        return view('kali', compact('jumlah', 'title'));
    }

    public function bagi()
    {
        $title = "Pembagian";
        return view('bagi', compact('title'));
    }
}
