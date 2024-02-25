<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Role;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { //
        $user = User::all();
        return view('admin.user.user-index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.user-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,dinas,sekolah,user',
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = $validatedData['role'];

        $user->save();

        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dId = decrypt($id);
        $show = User::findOrFail($dId);
        $peminjamans = Peminjaman::where('user_id', $dId)
            ->whereIn('status', ['Dipinjam', 'Booked', 'Proses Pengembalian'])
            ->get();

        return view('admin.user.user-detail', compact('show', 'peminjamans'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dId = decrypt($id);
        $edit = User::findOrFail($dId);
        return view('admin.user.user-form', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,dinas,sekolah,user',
        ]);

    
        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->role = $validatedData['role'];

        $user->save();

        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dId = decrypt($id);
        $user = User::findOrFail($dId);
        $user->delete();
        $notif = array(
            'message' => 'User Telah Berhasil Dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('jurusan.index')->with($notif);
    }
}
