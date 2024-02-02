<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'us_nama' => ['required', 'max:100',],
            'us_noinduk' => ['required','numeric'],
            'us_role' => ['required'],
            'us_email' => ['required', 'email'],
            'us_telepon' => ['required' , 'numeric'],
            'us_username' => ['required', 'max:255',],
            'us_password' => ['required', 'min:3'],
        ];
    }

        /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'us_nama.required' => 'Nama harus diisi.',
            'us_nama.max' => 'Nama tidak boleh lebih dari 100 karakter.',
            'us_nama.unique' => 'Nama sudah digunakan, harap pilih nama lain.',
            'us_noinduk.required' => 'Nomor Induk harus diisi.',
            'us_noinduk.numeric' => 'Nomor Induk harus berupa angka.',
            'us_role.required' => 'Peran harus diisi.',
            'us_email.required' => 'Email harus diisi.',
            'us_email.email' => 'Format email tidak valid.',
            'us_telepon.required' => 'Nomor Telepon harus diisi.',
            'us_telepon.numeric' => 'Nomor Telepon harus berupa angka.',
            'us_username.required' => 'Nama Pengguna harus diisi.',
            'us_username.max' => 'Nama Pengguna tidak boleh lebih dari 255 karakter.',
            'us_username.unique' => 'Nama Pengguna sudah digunakan, harap pilih username lain.',
            'us_password.required' => 'Kata Sandi harus diisi.',
            'us_password.min' => 'Kata Sandi harus memiliki minimal 3 karakter.',
        ];
    }

}
