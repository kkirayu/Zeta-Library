<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{

    public function updateStatus(Request $request, $id, Peminjaman $peminjaman)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $request->validate([
            'status' => 'required|in:Ready,Booked,Dipinjam,Proses Pengembalian,Sudah Dikembalikan',
        ]);
    
        if ($request->status == 'Proses Pengembalian') {
            if (!$peminjaman->tanggal_dikembalikan) {
                $peminjaman->tanggal_dikembalikan = now();
            }
        } elseif ($request->status == 'Ready') {
            $peminjaman->tanggal_dikembalikan = null;
        }
    
        $peminjaman->status = $request->status;
        $peminjaman->save();
    
        $buku = $peminjaman->buku;
        if ($request->status == 'Sudah Dikembalikan') {
            $buku->stok += 1;
        } elseif ($request->status == 'Dipinjam') {
            $buku->stok -= 1;
        }
        $buku->save();
        return redirect()->back()->with('success', 'Status updated successfully');
    }    
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = Peminjaman::all();
        return view('admin.peminjaman.peminjaman-index', compact('peminjaman'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buku = Buku::all();
        $users = User::all();
        return view('admin.peminjaman.peminjaman-form', compact('users', 'buku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'user_id' => 'required',
        //     'buku_id' => 'required',
        //     'tanggal_pinjam' => 'required|date',
        //     'tanggal_pengembalian' => 'required|date',
        // ]);

        $peminjaman = new Peminjaman();
        $peminjaman->user_id = $request->user_id;
        $peminjaman->buku_id = $request->buku_id;
        $peminjaman->tanggal_pinjaman = $request->tanggal_pinjaman;
        $peminjaman->tanggal_pengembalian = $request->tanggal_pengembalian;
        $peminjaman->status = $request->status;
        $peminjaman->save();

        $status = $request->status;
        $buku = Buku::find($request->buku_id);

        if ($status == 'Sudah Dikembalikan') {
            $buku->stok += 1;
        } elseif ($status == 'Dipinjam') {
            $buku->stok -= 1;
        }

        $buku->save();

        $notif = [
            'message' => 'Peminjaman Berhasil Dibuat',
            'alert-type' => 'success'
        ]; 
        
        if (Auth::user()->role == 'user') {
            // Jika role adalah user, redirect ke dashboard user
            return redirect()->route('user.dashboard')->with($notif);
        } else {
            // Jika role adalah role lain, redirect ke indeks peminjaman
            return redirect()->route('peminjaman.index')->with($notif);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dId = decrypt($id);
        $buku = Buku::all();
        $users = User::all();
        $edit = Peminjaman::findOrFail($dId);
        return view('admin.peminjaman.peminjaman-form', compact('users', 'buku', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {

        $peminjamanId = $request->id;
        $peminjaman = Peminjaman::findOrFail($peminjamanId);
        $peminjaman->user_id = $request->user_id;
        $peminjaman->buku_id = $request->buku_id;
        $peminjaman->tanggal_pinjaman = $request->tanggal_pinjaman;
        $peminjaman->tanggal_pengembalian = $request->tanggal_pengembalian;
        $peminjaman->status = $request->status;

        if ($request->status == 'Proses Pengembalian') {
            if (!$peminjaman->tanggal_dikembalikan) {
                $peminjaman->tanggal_dikembalikan = now();
            }
        } elseif ($request->status == 'Ready') {
            $peminjaman->tanggal_dikembalikan = null;
        }

        $peminjaman->save();

        $status = $request->status;
        $buku = Buku::find($request->buku_id);

        if ($status == 'Sudah Dikembalikan') {
            $buku->stok += 1;
        } elseif ($status == 'Dipinjam') {
            $buku->stok -= 1;
        }

        $buku->save();

        $notif = [
            'message' => 'Status Peminjaman Berhasil Diubah',
            'alert-type' => 'success'
        ];
        if (Auth::user()->role == 'user') {
            // Jika role adalah user, redirect ke dashboard user
            return redirect()->route('list.index')->with($notif);
        } else {
            // Jika role adalah role lain, redirect ke indeks peminjaman
            return redirect()->route('peminjaman.index')->with($notif);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dId = decrypt($id);
        $peminjaman = Peminjaman::findOrFail($dId);
        $peminjaman->delete();
        $notif = array(
            'message' => 'Peminjaman Telah Berhasil Dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('peminjaman.index')->with($notif);
    }

    public function checkAndDeleteExpired($id)
    {
        $expiredPeminjamans = Peminjaman::where('status', 'Dipinjam')
            ->where('update_at', '<=', Carbon::now()->subMinutes(5))
            ->get();

        foreach ($expiredPeminjamans as $peminjaman) {
            $peminjaman->update(['status' => 'Sudah Dikembalikan']);
            $dId = decrypt($id);
            $peminjaman = Peminjaman::findOrFail($dId);
            $peminjaman->delete();
        }

        return response()->json(['message' => 'Expired peminjaman successfully processed.']);
    }
}
