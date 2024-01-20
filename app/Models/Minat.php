<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minat extends Model
{
    use HasFactory;

    protected $fillable = [
        'mn_idtopik',
        'mn_iduser',
        'mn_minat',
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
