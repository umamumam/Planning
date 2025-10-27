<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Planing extends Model
{
    use HasFactory;

    protected $table = 'planings';

    protected $fillable = [
        'judul',
        'kategori_id',
        'foto',
        'deskripsi',
        'alamat',
        'budget',
        'tgl_kontak',
        'status',
    ];
    protected $dates = [
        'tgl_kontak',
    ];
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function getFotosAttribute()
    {
        if (!$this->foto) {
            return [];
        }
        return explode('|', $this->foto);
    }
}
