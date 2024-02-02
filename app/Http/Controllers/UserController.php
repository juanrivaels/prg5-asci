<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', [ 'users' => $users]);
    }
    

     public function searchMahasiswa(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $mahasiswas = User::where('us_role', 'Mahasiswa')
            ->where('us_nama', 'like', '%' . $searchTerm . '%')
            ->get();

        return view('users.preview', ['mahasiswas' => $mahasiswas]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    { 
        $params = $request->validated();
    
        $params['us_status'] = 1;
        //$params['us_password'] = bcrypt($request->us_password);
    
        $user = User::create($params);
        
        if($request->hasFile('us_pasfoto')){
            $request->file('us_pasfoto')->move('pasfoto/', $request->file('us_pasfoto')->getClientOriginalName());
            $user->us_pasfoto = $request->file('us_pasfoto')->getClientOriginalName();
            $user->save();
        }
    
        if ($user) {
            return redirect(route('users.index'))->with('success', 'Berhasil menambahkan pengguna!');
        } else {
            return redirect(route('users.index'))->with('error', 'Gagal untuk menambahkan pengguna');
        }
    }
    

    public function edit($id)
    {

        $user = User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $params = $request->validated();

        // Update user data
        if ($user->update($params)) {
            // If there is a photo file, save the change to the us_pasfoto column
            if ($request->hasFile('us_pasfoto')) {
                $request->file('us_pasfoto')->move('pasfoto/', $request->file('us_pasfoto')->getClientOriginalName());
                $user->us_pasfoto = $request->file('us_pasfoto')->getClientOriginalName();
                $user->save();
            }

            return redirect(route('users.index'))->with('success', 'Berhasil diperbarui!');
        } else {
            return redirect(route('users.index'))->with('error', 'Gagal untuk update pengguna.');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->update(['us_status' => 0]);

        return redirect(route('users.index'))->with('success', 'Berhasil menghapus pengguna!');
    }
}
