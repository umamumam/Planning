<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MS extends Model
{
    use HasFactory;

    protected $table = 'ms';

    protected $fillable = [
        'jenis',
        'nama',
        'nominal',
        'status',
        'ket'
    ];
}
