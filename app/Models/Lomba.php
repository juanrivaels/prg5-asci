<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    use HasFactory;

    protected $fillable = [
        'lb_iduser',
        'lb_idtopik',
        'lb_judul',
        'lb_tglmulai',
        'lb_tglselesai',
        'lb_kategori',
        'lb_jenis',
        'lb_tingkat',
        'lb_status',
        'lb_penyelenggara',
        'lb_pelaksanaan',
        'lb_lokasi',
        'lb_deskripsi',
        'lb_gambar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'lb_iduser');
    }

    public function topik()
    {
        return $this->belongsTo(Topik::class, 'lb_idtopik');
    }
}
