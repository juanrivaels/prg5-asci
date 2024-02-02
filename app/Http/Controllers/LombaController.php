<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLombaRequest;
use App\Http\Requests\UpdateLombaRequest;
use App\Models\Lomba;
use App\Models\Topik;
use Illuminate\Http\Request;

class LombaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lombas = Lomba::all();
        return view('lomba.index', ['lombas' => $lombas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topiks = Topik::all();
        
        return view('lomba.create', ['topiks' => $topiks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLombaRequest $request)
    {
        $params = $request->validated();
        
        // Menetapkan nilai us_status secara eksplisit
        $params['lb_status'] = 1;

        $params['lb_iduser'] = session('user.id');

        $lomba = Lomba::create($params);
        
        if($request->hasFile('lb_gambar')){
            $request->file('lb_gambar')->move('sertifikat/', $request->file('lb_gambar')->getClientOriginalName());
            $lomba->lb_gambar = $request->file('lb_gambar')->getClientOriginalName();
            $lomba->save();
        }
    
        if ($lomba) {
            return redirect(route('lomba.index'))->with('success', 'Berhasil menambahkan Lomba!');
        } else {
            return redirect(route('lomba.index'))->with('error', 'Gagal untuk menambahkan Lomba');
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
        $lomba = Lomba::findOrFail($id);
        $topiks = Topik::all();
        return view('lomba.edit', ['lomba' => $lomba] , ['topiks' => $topiks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLombaRequest $request, $id)
    {
        $lomba = Lomba::findOrFail($id);
        $params = $request->validated();

        // Update lomba data
        if ($lomba->update($params)) {
            // If there is a photo file, save the change to the lb_gambar column
            if ($request->hasFile('lb_gambar')) {
                $request->file('lb_gambar')->move('sertifikat/', $request->file('lb_gambar')->getClientOriginalName());
                $lomba->lb_gambar = $request->file('lb_gambar')->getClientOriginalName();
                $lomba->save();
            }

            return redirect(route('lomba.index'))->with('success', 'Berhasil memperbarui lomba!');
        } else {
            return redirect(route('lomba.index'))->with('error', 'Gagal untuk perbarui Lomba.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lomba = Lomba::findOrFail($id);

        $lomba->update(['lb_status' => 0]);

        return redirect(route('lomba.index'))->with('success', 'Lomba berhasil dihapus!');
    }
}
