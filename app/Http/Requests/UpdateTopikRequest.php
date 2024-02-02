<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTopikRequest extends FormRequest
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
            'tp_nama' => ['required', 'max:100'],
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
            'tp_nama.required' => 'Nama topik harus diisi.',
            'tp_nama.max' => 'Nama topik tidak boleh lebih dari 100 karakter.',
        ];
    }
}
