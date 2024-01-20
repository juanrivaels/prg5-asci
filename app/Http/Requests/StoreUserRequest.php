<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'us_nama' => ['required', 'max:100', Rule::unique('users', 'us_nama')],
            'us_noinduk' => ['required','numeric'],
            'us_role' => ['required'],
            'us_email' => ['required', 'email'],
            'us_telepon' => ['required' , 'numeric'],
            'us_username' => ['required', 'max:255', Rule::unique('users', 'us_username')],
            'us_password' => ['required', 'min:5'],
            'us_pasfoto' => 'required|image|mimes:jpeg,png,jpg|max:10240',
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
            'us_username.required' => 'Username harus diisi.',
            'us_username.max' => 'Username tidak boleh lebih dari 255 karakter.',
            'us_username.unique' => 'Username sudah digunakan, harap pilih username lain.',
        ];
    }
}
