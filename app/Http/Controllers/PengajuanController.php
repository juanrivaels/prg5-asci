<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Sertifikat;
use App\Models\Pengajuan;
use App\Models\User;
use App\Models\Lomba;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                // Ambil informasi pengguna yang sedang login dari session
                $loggedInUserId = session('user.id');

                // Mengambil data pendaftaran hanya untuk pengguna yang sedang login
                $pendaftarans = Pendaftaran::all();
        
                $users = User::all();
                $lombas = Lomba::all();
                $pengajuans = Pengajuan::where('pn_userid', $loggedInUserId)
                ->with('lomba', 'user', 'dosen') // Pastikan untuk mengambil relasi yang diperlukan
                ->get();
        
                return view('pengajuan.index', compact('pendaftarans', 'lombas', 'users', 'pengajuans'));
                
    }

    public function indexhistori()
    {
                // Ambil informasi pengguna yang sedang login dari session
                $loggedInUserId = session('user.id');

                // Mengambil data pendaftaran hanya untuk pengguna yang sedang login
                $pendaftarans = Pendaftaran::all();
        
                $users = User::all();
                $lombas = Lomba::all();
                $pengajuans = Pengajuan::where('pn_iddosen', $loggedInUserId)
                ->with('lomba', 'user', 'dosen') // Pastikan untuk mengambil relasi yang diperlukan
                ->get();
        
                return view('pengajuan.indexhistori', compact('pendaftarans', 'lombas', 'users', 'pengajuans'));
                
    }



    public function indexpengajuandosen()
    {
                // Ambil informasi pengguna yang sedang login dari session
                $loggedInUserId = session('user.id');

                // Mengambil data pendaftaran hanya untuk pengguna yang sedang login
                $pendaftarans = Pendaftaran::all();
        
                $users = User::all();
                $lombas = Lomba::all();
                $pengajuans = Pengajuan::where('pn_iddosen', $loggedInUserId)
                ->with('lomba', 'user', 'dosen') // Pastikan untuk mengambil relasi yang diperlukan
                ->get();
        
                return view('pengajuan.indexpengajuandosen', compact('pendaftarans', 'lombas', 'users', 'pengajuans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        //$topiks = Topik::all();
        $pendaftarans = Pendaftaran::all(); 
        $lombas = Lomba::all();
        $sertifikats = Sertifikat::all();
    
        return view('pengajuan.create', compact('users','pendaftarans', 'lombas', 'sertifikats'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'pn_idpendaftaran' => 'required',
            'pn_tglpengajuan' => 'required|date',
            'pn_revisimahasiswa' => 'required',
            // Add validation for other fields as needed
        ]);

        // Create a new Lomba registration
        Pengajuan::create([
            'pn_userid' => $request->input('pn_userid'),
            'pn_idpendaftaran' => $request->input('pn_idpendaftaran'),
            'pn_tglpengajuan' => $request->input('pn_tglpengajuan'),
            'pn_revisimahasiswa' => $request->input('pn_revisimahasiswa'),
            'pn_idlomba' => $request->input('pn_idlomba'),
            'pn_iddosen' => $request->input('pn_iddosen'),
            'pn_status' => 1,
            // Add other fields here
        ]);

        // Redirect with success message
        return redirect()->route('pengajuan.create')->with('success', 'Pengajuan Bimbingan berhasil dibuat!');
    }

    public function editpengajuandosen($id)
    {
        $pendaftaran = Pengajuan::findOrFail($id);

        $pendaftaran->pn_status = 2;
        //$pendaftaran->pd_status = 3;
        $pendaftaran->save();

        return redirect()->route('pengajuan.indexpengajuandosen')->with('success', 'Pengajuan diterima');
    }

    public function revisipengajuandosen($id, Request $request)
    {
        $pendaftaran = Pengajuan::findOrFail($id);

        $pendaftaran->pn_status = 3;
        $pendaftaran->pn_revisidosen = $request->input('pn_revisidosen');
        $pendaftaran->save();

        return redirect()->route('pengajuan.indexpengajuandosen')->with('success', 'Bimbingan Selesai');
    }

    public function konklusi($id, Request $request)
    {
        $pendaftaran = Pengajuan::findOrFail($id);

        $pendaftaran->pn_konklusi = $request->input('pn_konklusi');
        $pendaftaran->save();

        return redirect()->route('pengajuan.index')->with('success', 'Bimbingan Selesai');
    }

    public function destroypengajuan($id, Request $request)
    {
        $pendaftaran = Pengajuan::findOrFail($id);

        // Assuming you have a 'statuspengajuan' column in your 'pendaftarans' table
        $pendaftaran->pn_status = 4;
        $pendaftaran->pn_alasantolak = $request->input('pn_alasantolak');
        $pendaftaran->save();

        return redirect()->route('pendaftaran.indexdosen')->with('success', 'Pengajuan ditolak');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
