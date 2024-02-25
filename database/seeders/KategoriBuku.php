<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriBuku extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Daftar nama kategori yang mungkin
        $kategori = ['Fiksi', 'Non-Fiksi', 'Fantasi', 'Novel', 'Teknologi', 'Sejarah', 'Biografi', 'Politik', 'Bisnis', 'Seni', 'Olahraga', 'Musik', 'Pendidikan', 'Kesehatan', 'Kuliner', 'Pertanian', 'Perjalanan', 'Keluarga', 'Anak-anak', 'Remaja'];

        // Menambahkan 20 kategori buku dengan nama dan deskripsi acak
        for ($i = 0; $i < 20; $i++) {
            DB::table('kategori_bukus')->insert([
                'nama_kategori' => $kategori[array_rand($kategori)],
                'deskripsi' => 'Deskripsi kategori buku ini.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
