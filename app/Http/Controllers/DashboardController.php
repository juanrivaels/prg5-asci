<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lomba;

class DashboardController extends Controller
{
    public function index()
    {
        $lombas = Lomba::all();

        // Menghitung jumlah Lomba Akademik
        $totalAkademik = Lomba::where('lb_kategori', '0')->count();

        // Menghitung jumlah Lomba Non-Akademik
        $totalNonAkademik = Lomba::where('lb_kategori', '1')->count();

        return view('dashboard', ['lombas' => $lombas], [
            'totalAkademik' => $totalAkademik,
            'totalNonAkademik' => $totalNonAkademik,
        ]);
    }

    public function jumlahLomba()
    {
        // Menghitung jumlah Lomba Akademik
        $totalAkademik = Lomba::where('lb_kategori', '0')->count();

        // Menghitung jumlah Lomba Non-Akademik
        $totalNonAkademik = Lomba::where('lb_kategori', '1')->count();

        // Menampilkan hasil
        return view('dashboard', [
            'totalAkademik' => $totalAkademik,
            'totalNonAkademik' => $totalNonAkademik,
        ]);
    }
}
