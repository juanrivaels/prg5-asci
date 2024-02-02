<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLombaRequest extends FormRequest
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
            'lb_tglmulai' => ['required', 'date'],
            'lb_tglselesai' => [
                'required',
                'date',
                Rule::notIn([$this->input('lb_tglmulai')]), // Tglselesai tidak boleh sama dengan tglmulai
                function ($attribute, $value, $fail) {
                    $tglMulai = strtotime($this->input('lb_tglmulai'));
                    $tglSelesai = strtotime($value);

                    // Minimal 7 hari setelah tglmulai
                    if ($tglSelesai <= $tglMulai || ($tglSelesai - $tglMulai) < 7 * 24 * 60 * 60) {
                        $fail('Tanggal selesai minimal 7 hari setelah tanggal mulai.');
                    }
                },
            ],
            'lb_kategori' => ['required', 'in:0,1'],
            'lb_idtopik' => ['required', 'exists:topiks,id'],
            'lb_jenis' => ['required', 'in:0,1,2'],
            'lb_tingkatan' => ['required', 'in:0,1,2,3'],
            'lb_penyelenggara' => ['required', 'max:255'],
            'lb_pelaksanaan' => ['required', 'in:0,1'],
            'lb_lokasi' => ['nullable', 'max:255'],
            'lb_deskripsi' => ['required'],
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
            'lb_judul.required' => 'Judul lomba harus diisi.',
            'lb_judul.max' => 'Judul lomba tidak boleh lebih dari 255 karakter.',
            'lb_tglmulai.required' => 'Tanggal mulai harus diisi.',
            'lb_tglmulai.date' => 'Format tanggal mulai tidak valid.',
            'lb_tglselesai.required' => 'Tanggal selesai harus diisi.',
            'lb_tglselesai.date' => 'Format tanggal selesai tidak valid.',
            'lb_tglselesai.not_in' => 'Tanggal selesai tidak boleh sama dengan tanggal mulai.',
            'lb_tglselesai' => 'Tanggal selesai minimal 7 hari setelah tanggal mulai.',
            'lb_kategori.required' => 'Kategori lomba harus diisi.',
            'lb_kategori.in' => 'Pilihan kategori lomba tidak valid.',
            'lb_idtopik.required' => 'Topik lomba harus diisi.',
            'lb_idtopik.exists' => 'Topik lomba tidak valid.',
            'lb_jenis.required' => 'Jenis lomba harus diisi.',
            'lb_jenis.in' => 'Pilihan jenis lomba tidak valid.',
            'lb_tingkat.required' => 'Tingkat lomba harus diisi.',
            'lb_tingkat.in' => 'Pilihan tingkat lomba tidak valid.',
            'lb_penyelenggara.required' => 'Penyelenggara lomba harus diisi.',
            'lb_penyelenggara.max' => 'Penyelenggara lomba tidak boleh lebih dari 255 karakter.',
            'lb_pelaksanaan.required' => 'Pelaksanaan lomba harus diisi.',
            'lb_pelaksanaan.in' => 'Pilihan pelaksanaan lomba tidak valid.',
            'lb_lokasi.max' => 'Lokasi lomba tidak boleh lebih dari 255 karakter.',
            'lb_deskripsi.required' => 'Deskripsi lomba harus diisi.',
        ];
    }
}
