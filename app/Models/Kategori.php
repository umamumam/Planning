<?php

namespace App\Models;

use App\Models\Planing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    protected $fillable = ['nama'];

    public function planings(): HasMany
    {
        return $this->hasMany(Planing::class, 'kategori_id');
    }
}
