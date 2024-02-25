<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\kategori_buku;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PeminjamanExport;
use App\Imports\BukuImport;
use Intervention\Image\Facades\Image;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoriBuku = kategori_buku::all();
        $buku = Buku::all();
        return view('admin.buku.buku-index', compact('buku','kategoriBuku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriBuku = kategori_buku::all();
        return view('admin.buku.buku-form', compact('kategoriBuku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());


        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string',
            'kategori' => 'required|string',
            'tahun_terbit' => 'required|date',
            'stok' => 'required',
        ]);

        $photo = $request->file('photo');
        $genNama = hexdec(uniqid()) . '.' . $photo->getClientOriginalExtension();
        Image::make($photo)->resize(300, 300)->save('upload/produk/' . $genNama);
        $save_url = 'upload/produk/' . $genNama;


        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->kategori = $request->kategori;
        $buku->photo = $save_url;
        $buku->stok = $request->stok;

        $buku->save();
        $notif = array(
            'message' => 'Buku Berhasil Ditambah',
            'alert-type' => 'success'
        );
        return redirect()->route('buku.index')->with($notif);
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dId = decrypt($id);
        $edit = Buku::findOrFail($dId);
        $kategoriBuku = kategori_buku::all();
        return view('admin.buku.buku-form', compact('kategoriBuku','edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string',
            'tahun_terbit' => 'required|date',
            'stok' => 'required',
            'kategori' => 'required|string',
            
        ]);

        $produkId = $request->id;
        $photoLama = $request->photoLama;

        if ($request->file('photos')) {
            $photo = $request->file('photos');
            @unlink(public_path($photoLama));
            $genNama = hexdec(uniqid()) . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(300, 300)->save('upload/produk/' . $genNama);
            $save_url = 'upload/produk/' . $genNama;
        } else {
            $save_url = $photoLama;
        }

        $bukuId = $request->id;
        $buku = Buku::findOrFail($bukuId);
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->stok = $request->stok;
        $buku->photo = $save_url;
        $buku->kategori = $request->kategori;

        $buku->save();
        $notif = array(
            'message' => 'Buku Berhasil Ditambah',
            'alert-type' => 'success'
        );
        return redirect()->route('buku.index')->with($notif);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dId = decrypt($id);
        $buku = Buku::findOrFail($dId);
        $buku->delete();
        $notif = array(
            'message' => 'Buku Telah Berhasil Dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('buku.index')->with($notif);
    }

    public function export() 
    {
        return Excel::download(new PeminjamanExport, 'peminjaman.xlsx');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('userfile', $nama_file);
        Excel::import(new BukuImport, public_path('/userfile/' . $nama_file));
        return redirect()->route('buku.index');
    }

}
