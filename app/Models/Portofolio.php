<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'pfo_iduser',
        'pfo_idtopik',
        'pfo_file',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'pfo_iduser');
    }

    public function topik()
    {
        return $this->belongsTo(Topik::class, 'pfo_idtopik');
    }
}
