<?php

namespace App\Imports;

use App\Models\Buku;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class BukuImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Buku([
            'judul'     => $row[0],
            'penulis'    => $row[1],
            'penerbit'    => $row[2],
            'tahun_terbit' => $row[3],  
            'kategori'    => $row[4],
        ]);
    }
}
