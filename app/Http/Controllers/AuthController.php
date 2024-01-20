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

    public function loginAction(Request $request){
        $user = User::where('us_username', $request->input('Username'))->first();

        session(['user.id' => $user->id]); 
        session(['user.name' => $user->us_nama]);
        session(['user.email' => $user->us_email]);
        session(['user.us_pasfoto' => $user->us_pasfoto]);
        session(['user.role' => $user->us_role]);
    
        if($user && $user->us_password == $request->input('Password')){
            $role = $user->us_role;
    
            if($role == 'Admin'){
                return redirect(route('dashboard.index'));
            } elseif($role == 'Himma'){
                return redirect(route('dashboard.index'));
            } elseif($role == 'Dosen'){
                return redirect(route('dashboard.index'));
            } elseif($role == 'Mahasiswa'){
                return redirect(route('dashboard.index'));
            } else {
                // Handle other roles or scenarios
            }
        } else {
            return redirect(route('auth.login'))->with('error', 'Wrong username or password!');
        }
    }
}
