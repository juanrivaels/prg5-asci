<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pn_userid',
        'pn_iddosen',
        'pn_idlomba',
        'pn_idpendaftaran',
        'pn_revisimahasiswa',
        'pn_alasantolak',
        'pn_revisidosen',
        'pn_tglpengajuan',
        'pn_status',
    ];

    public function pengajuans()
    {
        return $this->belongsTo(Pengajuan::class, 'id');
    }

    public function pendaftarans()
    {
        return $this->belongsTo(Pendaftaran::class, 'pn_idpendaftaran');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'pn_userid');
    }

    public function dosen()
    {
        return $this->belongsTo(User::class, 'pn_iddosen');
    }

    public function lomba()
    {
        return $this->belongsTo(Lomba::class, 'pn_idlomba');
    }
    

}
