<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
    use HasFactory;

    protected $fillable = [
        'tp_iduser',
        'tp_nama',
        'tp_status',
    ];

    public function topiks(){
        return $this->belongsToMany(Lomba::class);
    }

    
}
