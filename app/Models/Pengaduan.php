<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengaduan extends Model
{
    protected $fillable = [
        'name',
        'ruangan',
        'deskripsi',
        'siswa_id',
        'category_id',
        'status',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}