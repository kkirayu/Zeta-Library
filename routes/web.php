<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/', [AuthenticatedSessionController::class, 'create'])
->name('login');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'role:admin,petugas']], function () {
    Route::get('/admin/dashboard',[AdminController::class,'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile',[AdminController::class,'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/update',[AdminController::class,'adminProfileUpdate'])->name('admin.profile.update');
    Route::post('/admin/profile/update-password',[AdminController::class,'adminProfileUpdatepassword'])->name('admin.profile.updatePassword');
    Route::resource('/admin/kategori', KategoriBukuController::class);
    Route::get('/admin/kategori/destroy/{id}', [KategoriBukuController::class, 'destroy'])->name('kategori.destroy');
    Route::get('buku/export/', [BukuController::class, 'export'])->name('export.pinjaman');
    Route::get('users/export/', [AdminController::class, 'export'])->name('export.user');
    Route::post('/buku/import', [BukuController::class, 'import'])->name('import.excel');
    Route::resource('/admin/user', UserController::class);
    Route::get('/admin/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    
});

Route::group(['middleware' => ['auth', 'role:admin,petugas,user']], function () {
    Route::get('/admin/logout',[AdminController::class,'adminLogout'])->name('admin.logout');
    Route::resource('/admin/buku', BukuController::class);
    Route::get('/admin/buku/destroy/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
    Route::get('/user/peminjaman',[PeminjamanController::class,'create'])->name('peminjaman.create');
    Route::post('/user/peminjaman',[PeminjamanController::class,'store'])->name('peminjaman.store');
    Route::resource('/admin/peminjaman', PeminjamanController::class);
    Route::put('/peminjaman/{id}/update-status', [PeminjamanController::class, 'updateStatus'])->name('update.status');
    Route::get('/peminjaman/check-and-delete-expired', [PeminjamanController::class, 'checkAndDeleteExpired'])->name('expired');
    Route::resource('/user/list', ReportController::class);
});


Route::group(['middleware' => ['auth', 'role:user']], function () {
Route::get('/user/dashboard',[AdminController::class,'adminDashboard'])->name('user.dashboard');

});
Route::get('/admin/peminjaman/destroy/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
require __DIR__.'/auth.php';
