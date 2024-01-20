<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopikController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PortofolioController;
//use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MinatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ROUTE LOGIN
Route::get('login',[AuthController::class,'index'])->name('auth.login');
Route::get('login/action',[AuthController::class,'loginAction'])->name('auth.action');

//ROUTE DASHBOARD
Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard.index');

// ROUTE USER
Route::get('users',[UserController::class,'index'])->name('users.index');
Route::get('users/create',[UserController::class,'create'])->name('users.create');
Route::post('users',[UserController::class,'store'])->name('users.store');
Route::get('users/{id}/edit',[UserController::class,'edit'])->name('users.edit');
Route::put('users/{id}',[UserController::class,'update'])->name('users.update');
Route::delete('users/{id}',[UserController::class,'destroy'])->name('users.destroy');

// ROUTE TOPIK
Route::get('topik',[TopikController::class,'index'])->name('topik.index');
Route::get('topik/create',[TopikController::class,'create'])->name('topik.create');
Route::post('topik',[TopikController::class,'store'])->name('topik.store');
Route::get('topik/{id}/edit',[TopikController::class,'edit'])->name('topik.edit');
Route::put('topik/{id}',[TopikController::class,'update'])->name('topik.update');
Route::delete('topik/{id}',[TopikController::class,'destroy'])->name('topik.destroy');

//ROUTE LOMBA
Route::get('lomba',[LombaController::class,'index'])->name('lomba.index');
Route::get('lomba/create',[LombaController::class,'create'])->name('lomba.create');
Route::post('lomba',[LombaController::class,'store'])->name('lomba.store');
Route::get('lomba/{id}/edit',[LombaController::class,'edit'])->name('lomba.edit');
Route::put('lomba/{id}',[LombaController::class,'update'])->name('lomba.update');
Route::delete('lomba/{id}',[LombaController::class,'destroy'])->name('lomba.destroy');

//ROUTE MAHASISWA
Route::get('mahasiswa',[MahasiswaController::class,'index'])->name('mahasiswa.index');

//ROUTE PENDAFTARAN
Route::get('pendaftaran',[PendaftaranController::class,'index'])->name('pendaftaran.index');
Route::post('pendaftaran',[PendaftaranController::class,'store'])->name('pendaftaran.store');
Route::get('pendaftaranadmin',[PendaftaranController::class,'indexadmin'])->name('pendaftaran.indexadmin');
Route::get('pendaftarandosen',[PendaftaranController::class,'indexdosen'])->name('pendaftaran.indexdosen');
Route::get('pendaftaran/create',[PendaftaranController::class,'create'])->name('pendaftaran.create');
Route::get('pendaftaran/createsertifikat',[PendaftaranController::class,'createsertifikat'])->name('pendaftaran.createsertifikat');
Route::post('pendaftaran/createsertifikatmhs',[PendaftaranController::class,'storesertifikat'])->name('pendaftaran.storesertifikat');
Route::get('pendaftaran/{id}/edit',[PendaftaranController::class,'editdosen'])->name('pendaftaran.editdosen');
//Route::put('pendaftaran/{id}',[PendaftaranController::class,'updatedosen'])->name('pendaftaran.updatedosen');
Route::delete('pendaftaran/{id}',[PendaftaranController::class,'destroy'])->name('pendaftaran.destroy');
Route::post('/pendaftaran/reject/{id}', [PendaftaranController::class,'reject'])->name('pendaftaran.reject');
Route::get('/update-status/{id}/{status}', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.updateStatus');
// Route::get('/pendaftaran/statussemifinal/{id}', [PendaftaranController::class, 'statussemifinal'])->name('pendaftaran.statussemifinal');
// Route::get('/pendaftaran/statusfinal/{id}', [PendaftaranController::class, 'statusfinal'])->name('pendaftaran.statusfinal');
// Route::get('/pendaftaran/statusselesai/{id}', [PendaftaranController::class, 'statusselesai'])->name('pendaftaran.statusselesai');
// routes/web.php

Route::post('/competition/change-status/{pendaftaran}', [PendaftaranController::class, 'changeStatus'])->name('competition.changeStatus');

//ROUTE DOSEN
Route::get('dosen',[DosenController::class,'index'])->name('dosen.index');
Route::post('dosen',[DosenController::class,'store'])->name('dosen.store');
Route::get('dosen/{id}/edit',[DosenController::class,'edit'])->name('dosen.edit');
Route::put('dosen/{id}',[DosenController::class,'update'])->name('dosen.update');

//ROUTE PORTOFOLIO
Route::get('portofolio/create',[PortofolioController::class,'create'])->name('portofolio.create');
Route::post('portofolio',[PortofolioController::class,'store'])->name('portofolio.store');

//ROUTE MINAT
Route::get('minat/create',[MinatController::class,'create'])->name('minat.create');
Route::post('minat',[MinatController::class,'store'])->name('minat.store');

//ROUTE LAPORAN
Route::get('laporan',[PendaftaranController::class,'laporan'])->name('pendaftaran.laporan');


Route::get('/', function () {
    return view('welcome');
});

