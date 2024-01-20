<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('mahasiswa.index', ['users' => $users]);
    }
}
