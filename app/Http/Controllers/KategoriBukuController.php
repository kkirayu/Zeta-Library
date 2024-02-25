<?php

namespace App\Http\Controllers;

use App\Models\kategori_buku;
use Illuminate\Http\Request;

class KategoriBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = kategori_buku::all();
        return view('admin.kategori.kategori-index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.kategori-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $kategori = new kategori_buku();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->deskripsi = $request->deskripsi;

        $kategori->save();
        $notif = array(
            'message' => 'Category Berhasil Ditambah',
            'alert-type' => 'success'
        );
        return redirect()->route('kategori.index')->with($notif);
    }

    /**
     * Display the specified resource.
     */
    public function show(kategori_buku $kategori_buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dId = decrypt($id);
        $edit = kategori_buku::findOrFail($dId);
        return view('admin.kategori.kategori-form', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kategori_buku $kategori_buku)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $kategoriId = $request->id;
        $kategori = kategori_buku::findOrFail($kategoriId);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->deskripsi = $request->deskripsi;

        $kategori->save();
        $notif = array(
            'message' => 'Category Berhasil Diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('kategori.index')->with($notif);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dId = decrypt($id);
        $kategori = kategori_buku::findOrFail($dId);
        $kategori->delete();
        $notif = array(
            'message' => 'Category Telah Berhasil Dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('kategori.index')->with($notif);
    }
}
