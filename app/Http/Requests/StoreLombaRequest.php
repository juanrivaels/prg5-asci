<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLombaRequest extends FormRequest
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
            'lb_judul' => ['required', 'max:255'],
            'lb_tglmulai' => 'required|date',
            'lb_tglselesai' => [
                'required',
                'date',
                Rule::notIn([$this->input('lb_tglmulai')]), // Tglselesai tidak boleh sama dengan tglmulai
                function ($attribute, $value, $fail) {
                    $tglMulai = strtotime($this->input('lb_tglmulai'));
                    $tglSelesai = strtotime($value);

                    // Minimal 7 hari setelah tglmulai
                    if ($tglSelesai <= $tglMulai || ($tglSelesai - $tglMulai) < 7 * 24 * 60 * 60) {
                        $fail('Tanggal '.$attribute.' selesai minimal 7 hari setelah tanggal mulai.');
                    }
                },
            ],
            'lb_kategori' => ['required', 'in:0,1'],
            'lb_idtopik' => ['required', 'exists:topiks,id'],
            'lb_jenis' => ['required', 'in:0,1,2'],
            'lb_tingkat' => ['required', 'in:0,1,2,3'],
            'lb_penyelenggara' => ['required', 'max:255'],
            'lb_pelaksanaan' => ['required', 'in:0,1'],
            'lb_lokasi' => ['nullable', 'max:255'],
            'lb_deskripsi' => ['required'],
            'lb_gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:10240'],
        ];
    }
}
