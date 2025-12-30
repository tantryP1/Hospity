<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonfirmasiController extends Controller
{
    public function show($id)
    {
        // Logika untuk mengambil data berdasarkan ID dan menampilkan halaman konfirmasi
        return view('konfirmasi', ['id' => $id]);
    }
}