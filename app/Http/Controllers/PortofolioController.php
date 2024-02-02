<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Sertifikat;
use App\Models\Portofolio;
use App\Models\User;
use App\Models\Topik;
use App\Models\Lomba;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $topiks = Topik::all();

        return view('portofolio.create', [
            'topiks' => $topiks,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->all();

        $porto = Portofolio::create($params);

        if($request->hasFile('pfo_file')){
            $request->file('pfo_file')->move('portofolio/', $request->file('pfo_file')->getClientOriginalName());
            $porto->pfo_file = $request->file('pfo_file')->getClientOriginalName();
            $porto->save();
        }
    
        if ($porto) {
            return redirect(route('portofolio.create'))->with('success', 'Berhasil menambahkan Portofolio!');
        } else {
            return redirect(route('portofolio.create'))->with('error', 'Gagal untuk menambahkan Portofolio.');
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
