<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StorePendaftaranRequest extends FormRequest
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
            'pd_userid' => 'required|exists:users,id',
            'pd_idlomba' => 'required|exists:lombas,id',
            'pd_iddosen' => 'required|exists:users,id',
            'pd_tgldaftar' => [
                'required',
                'date',

            ],
            'pd_alasan' => 'nullable',
            'pd_buktistatus' => 'nullable',
            'pd_tglpengajuan' => 'nullable|date',
            'pd_statuspengajuan' => 'nullable',
        ];
    }
}
