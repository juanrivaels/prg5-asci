<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pd_userid',
        'pd_iddosen',
        'pd_idlomba',
        'pd_idsertifikat',
        'pd_tgldaftar',
        'pd_status',
        'pd_alasan',
        'pd_buktistatus',
        'pd_tglpengajuan',
        'pd_statuspengajuan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'pd_userid');
    }

    public function dosen()
    {
        return $this->belongsTo(User::class, 'pd_iddosen');
    }

    public function lomba()
    {
        return $this->belongsTo(Lomba::class, 'pd_idlomba');
    }

    public function sertifikat()
    {
        return $this->belongsTo(Sertifikat::class, 'pd_idsertifikat');
    }

}
