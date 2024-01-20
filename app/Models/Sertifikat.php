<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $fillable = [
        'sf_userid',
        'sf_idlomba',
        'sf_idpendaftaran',
        'sf_juara',
        'sf_sertifikat',
        'sf_tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'sf_userid');
    }

    public function lomba()
    {
        return $this->belongsTo(Lomba::class, 'sf_idlomba');
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'sf_idpendaftaran');
    }

    
}
