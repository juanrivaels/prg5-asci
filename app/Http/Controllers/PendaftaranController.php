<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePendaftaranRequest;
use App\Http\Requests\UpdatePendaftaranRequest;
use App\Models\Pendaftaran;
use App\Models\Sertifikat;
use App\Models\User;
use App\Models\Lomba;

class PendaftaranController extends Controller
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
        $pendaftarans = Pendaftaran::where('pd_userid', $loggedInUserId)
            ->with('lomba', 'user', 'dosen') // Pastikan untuk mengambil relasi yang diperlukan
            ->get();

        $users = User::all();
        $lombas = Lomba::all();

        return view('pendaftaran.index', compact('pendaftarans', 'lombas', 'users'));
    }

    public function indexadmin()
    {
        $pendaftarans = Pendaftaran::all();
        $users = User::all();
        $lombas = Lomba::all();

        return view('pendaftaran.indexadmin', compact('pendaftarans', 'lombas', 'users'));
    }

    public function laporan()
    {
        $pendaftarans = Pendaftaran::all();
        $users = User::all();
        $lombas = Lomba::all();
        $sertifikats = Sertifikat::all();

        return view('pendaftaran.laporan', compact('pendaftarans', 'lombas', 'users', 'sertifikats'));
    }

    public function indexdosen()
    {
        // Ambil informasi pengguna yang sedang login dari session
        $loggedInUserId = session('user.id');

        // Mengambil data pendaftaran hanya untuk pengguna yang sedang login
        $pendaftarans = Pendaftaran::where('pd_iddosen', $loggedInUserId)
            ->with('lomba', 'user', 'dosen') // Pastikan untuk mengambil relasi yang diperlukan
            ->get();

        $users = User::all();
        $lombas = Lomba::all();

        return view('pendaftaran.indexdosen', compact('pendaftarans', 'lombas', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $lombas = Lomba::all();

        return view('pendaftaran.create', ['lombas' => $lombas] , ['users' => $users]);
    }

    public function createsertifikat()
    {
        $users = User::all();
        $lombas = Lomba::all();
        $pendaftarans = Pendaftaran::where('pd_status', 7)
        ->where('pd_userid', session('user.id'))
        ->get();

        return view('pendaftaran.createsertifikat', [
            'lombas' => $lombas,
            'users' => $users,
            'pendaftarans' => $pendaftarans,
        ]);

        //return view('sertifikat.create', ['lombas' => $lombas] , ['users' => $users] , ['pendaftarans' => $pendaftarans]);
    }


    public function storesertifikat(Request $request)
    {
        $request->validate([
            'sf_juara' => 'required',
            'sf_tanggal' => 'required',
            'sf_sertifikat' => 'required', // Adjust file validation as needed
        ]);

        $params = $request->all();

        $sertif = Sertifikat::create($params);

        if($request->hasFile('sf_sertifikat')){
            $request->file('sf_sertifikat')->move('sertifikat/', $request->file('sf_sertifikat')->getClientOriginalName());
            $sertif->sf_sertifikat = $request->file('sf_sertifikat')->getClientOriginalName();
            $sertif->save();
        }
    
        if ($sertif) {
            return redirect(route('pendaftaran.createsertifikat'))->with('success', 'Added!');
        } else {
            return redirect(route('pendaftaran.createsertifikat'))->with('error', 'Failed to add Sertifikat.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePendaftaranRequest $request)
    {
        $params = $request->validated();
        $params['pd_status'] = 1;
        $params['pd_statuspengajuan'] = 1;
        $pendaftaran = Pendaftaran::create($params);

        if ($pendaftaran) {
            return redirect(route('pendaftaran.create'))->with('success', 'Added!');
        } else {
            return redirect(route('pendaftaran.create'))->with('error', 'Failed to add Pendaftaran.');
        }
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

    
    public function editdosen($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->pd_statuspengajuan = 2; 
        $pendaftaran->pd_status = 3;
        $pendaftaran->save();

        return redirect()->route('pendaftaran.indexdosen')->with('success', 'Pengajuan diterima');
    }

    public function statuspenyisihan($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->pd_status = 4;
        $pendaftaran->save();

        return redirect()->route('pendaftaran.index')->with('success', 'Status Berhasil Diubah!');
    }

    public function statussemifinal($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->pd_status = 5;
        $pendaftaran->save();

        return redirect()->route('pendaftaran.index')->with('success', 'Status Berhasil Diubah!');
    }

    public function statusfinal($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->pd_status = 6;
        $pendaftaran->save();

        return redirect()->route('pendaftaran.index')->with('success', 'Status Berhasil Diubah!');
    }

    public function statusselesai($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->pd_status = 7;
        $pendaftaran->save();

        return redirect()->route('pendaftaran.index')->with('success', 'Status Berhasil Diubah!');
    }

    public function changeStatus(Request $request, Pendaftaran $pendaftaran)
    {
        // Lakukan validasi dan verifikasi sesuai kebutuhan Anda
        // ...

        // Dapatkan status baru dari permintaan
        $newStatus = $request->input('status');

        // Periksa status baru dan terapkan perubahan sesuai kebutuhan
        switch ($newStatus) {
            case '4':
                $pendaftaran->pd_status = 4; // atau gunakan konstanta yang sesuai
                break;
            case '5':
                $pendaftaran->pd_status = 5;
                break;
            case '6':
                $pendaftaran->pd_status = 6;
                break;
            case '7':
                $pendaftaran->pd_status = 7;
                break;
            // Tambahkan case lain sesuai kebutuhan
        }

        // Simpan perubahan
        $pendaftaran->save();

        return response()->json(['message' => 'Status berhasil diubah.']);
    }

    public function updateStatus($id, $status)
{
    $pendaftaran = Pendaftaran::findOrFail($id);

    // Add any additional validation or checks as needed

    $pendaftaran->pd_status = $status;
    $pendaftaran->save();

    return response()->json(['success' => true]);
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

    // Example controller method in PendaftaranController.php
    public function reject($id, Request $request)
    {
        // Update the status and rejection reason
        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->pd_statuspengajuan = 3; // Assuming 3 is the status code for rejection
        $pendaftaran->pd_alasan = $request->input('rejectReason');
        $pendaftaran->save();

        // Redirect or return a response as needed
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Assuming you have a 'statuspengajuan' column in your 'pendaftarans' table
        $pendaftaran->pd_statuspengajuan = 3;
        $pendaftaran->pd_alasan = $request->input('pd_alasan');
        $pendaftaran->save();

        return redirect()->route('pendaftaran.indexdosen')->with('success', 'Pengajuan ditolak');
    }
}