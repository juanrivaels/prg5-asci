<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Sertifikat;
use App\Models\User;
use App\Models\Lomba;

class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $lombas = Lomba::all();
        $pendaftarans = Pendaftaran::where('pd_status', 7)
        ->where('pd_userid', session('user.id'))
        ->get();

        return view('sertifikats.create', [
            'lombas' => $lombas,
            'users' => $users,
            'pendaftarans' => $pendaftarans,
        ]);
    }

    public function downloadFile($file){
        $path = '../storage/app/sertifikat/'.$file;
        return response()->download($path, $file);
    }



    public function indexsertifikat()
    {
        $pendaftarans = Pendaftaran::all();
        $users = User::all();
        $lombas = Lomba::all();
        $sertifikats = Sertifikat::with('lomba')->get();

        return view('sertifikats.indexsertifikat', compact('pendaftarans', 'lombas', 'users', 'sertifikats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createsertifikat()
    {
        $users = User::all();
        $lombas = Lomba::all();
        $pendaftarans = Pendaftaran::where('pd_status', 7)
        ->where('pd_userid', session('user.id'))
        ->get();

        return view('sertifikats.createsertifikat', [
            'lombas' => $lombas,
            'users' => $users,
            'pendaftarans' => $pendaftarans,
        ]);

        //return view('sertifikat.create', ['lombas' => $lombas] , ['users' => $users] , ['pendaftarans' => $pendaftarans]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            return redirect(route('sertifikats.createsertifikat'))->with('success', 'Berhasil menambahkan sertifikat!');
        } else {
            return redirect(route('sertifikats.createsertifikat'))->with('error', 'Gagal untuk menambahkan Sertifikat.');
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
