<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'kategori',
        'photo',
    ];
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }
    public function kategori()
    {
        return $this->belongsTo(kategori_buku::class);
    }

    public function kategoriBuku()
{
    return $this->belongsTo(Kategori_buku::class, 'kategori');
}

}
