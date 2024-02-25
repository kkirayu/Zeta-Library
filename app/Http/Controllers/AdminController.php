<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Models\Buku;
use App\Models\Komentar;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{

    public function adminDashboard(){
        $buku = Buku::all();
        return view('admin.index', compact('buku'));
    }
    

    public function adminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function adminProfile(){
        $id = Auth::user()->id;
        $getUser = User::findOrFail($id);
        return view('admin.profile.profile-index', compact('getUser'));
    }

    public function adminProfileUpdate(Request $request){
        $id = Auth::user()->id;
        $username = Auth::user()->username;
        $getUser = User::findOrFail($id);

        $getUser->name = $request->name;
        $getUser->email = $request->email;
        


        $getUser->save();

        $notif = array(
            'message' => 'Profile Admin Berhasil Diubah',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notif);
    }

    public function adminProfileUpdatepassword(Request $request){

        $request->validate([
            'passwordLama' => 'required',
            'passwordBaru' => 'required|required_with:new_password_confirmation|same:new_password_confirmation'
        ]);

        if (!Hash::check($request->passwordLama, auth::user()->password)) {
            return back()->with("error", "Password Lama Tidak Cocok");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->passwordBaru)
        ]);

        return back()->with("status", "Password Berhasil Diubah");
    }

    public function export() 
    {
        return Excel::download(new UserExport, 'users.xlsx');
    }
}
