<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    
    public function index()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        $username = $request->input('Username');
        $password = $request->input('Password');
    
        $user = User::where('us_username', $username)->first();
    
        if ($user && $user->us_password == $password && $user->us_status == 1) {
            session(['user.id' => $user->id]); 
            session(['user.name' => $user->us_nama]);
            session(['user.email' => $user->us_email]);
            session(['user.us_pasfoto' => $user->us_pasfoto]);
            session(['user.role' => $user->us_role]);
    
            $role = $user->us_role;
    
            if ($role == 'Admin' || $role == 'Himma' || $role == 'Dosen' || $role == 'Mahasiswa'|| $role == 'Sekprod') {
                return redirect(route('dashboard.index'));
            } else {
                // Handle other roles or scenarios
            }
        } elseif ($user && $user->us_status == 0) {
            return redirect(route('auth.login'))->with('error', 'Akun nonaktif.');
        } else {
            return redirect(route('auth.login'))->with('error', 'Nama Pengguna atau Kata Sandi salah!');
        }
    }
    
}