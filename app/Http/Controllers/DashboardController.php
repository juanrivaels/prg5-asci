<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lomba;
use App\Models\Pendaftaran;
use App\Charts\JuaraChart;

class DashboardController extends Controller
{
    public function index()
    {
        $lombas = Lomba::all();
        $pendaftaran = Pendaftaran::all();
    
        // Menghitung jumlah Lomba Akademik
        $totalAkademik = Lomba::where('lb_kategori', '0')->where('lb_status', '1')->count();
    
        // Menghitung jumlah Lomba Non-Akademik
        $totalNonAkademik = Lomba::where('lb_kategori', '1')->where('lb_status', '1')->count();
    
        //COUNT STATUS PENGAJUAN
    
        //COUNT STATUS LOMBA
        $totalPenyisihan = Pendaftaran::where('pd_status', '4')->count();
        $totalFinal = Pendaftaran::where('pd_status', '5')->count();
        $totalSelesai = Pendaftaran::where('pd_status', '6')->count();
    
        // JuaraChart
        //$juaraChart = $juara->build();
    
        return view('dashboard', [
            'lombas' => $lombas,
            'totalAkademik' => $totalAkademik,
            'totalNonAkademik' => $totalNonAkademik,
            'totalPenyisihan' => $totalPenyisihan,
            'totalFinal' => $totalFinal,
            'totalSelesai' => $totalSelesai,
            //'JuaraChart' => $juaraChart->build(), // Add JuaraChart to the view data
        ]);
    }
    

    public function jumlahLomba()
    {
        $lombas = Lomba::all();
        $pendaftaran = Pendaftaran::all();

        // Menghitung jumlah Lomba Akademik
        $totalAkademik = Lomba::where('lb_kategori', '0')->count();

        // Menghitung jumlah Lomba Non-Akademik
        $totalNonAkademik = Lomba::where('lb_kategori', '1')->count();

        //COUNT STATUS PENGAJUAN
        $totalMenunggukonfirmasi = Pendaftaran::where('pd_statuspengajuan', '1')->count();
        $totalDiterima = Pendaftaran::where('pd_statuspengajuan', '2')->count();
        $totalDitolak = Pendaftaran::where('pd_statuspengajuan', '3')->count();

        //COUNT STATUS LOMBA
        $totalPenyisihan = Pendaftaran::where('pd_status', '4')->count();
        $totalFinal = Pendaftaran::where('pd_status', '6')-count();
        $totalSelesai = Pendaftaran::where('pd_status', '7')->count();

        return view('dashboard', [
            'lombas' => $lombas,
            'totalAkademik' => $totalAkademik,
            'totalNonAkademik' => $totalNonAkademik,
            'totalMenungguKonfirmasi' => $totalMenunggukonfirmasi,
            'totalDiterima' => $totalDiterima,
            'totalDitolak' => $totalDitolak,
            'totalPenyisihan' => $totalPenyisihan,
            'totalFinal' => $totalFinal,
            'totalSelesai' => $totalSelesai,
        ]);
    }
}
