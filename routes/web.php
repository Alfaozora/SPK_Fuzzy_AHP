<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\CripsController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SendEmailController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\IntensitasController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\HistoryController;
use Route as GlobalRoute;

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
#Login
Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login/action', [LoginController::class, 'postLogin'])->middleware('guest');
Route::get('/login/logout', [LoginController::class, 'logout'])->middleware(['auth']);

#Dashboard
Route::get('/', [HomeController::class, 'index'])->middleware(['auth'])->name('home');

#Kriteria
Route::resource('kriteria', KriteriaController::class)->middleware(['auth']);

#Crips
Route::resource('crips', CripsController::class)->middleware(['auth']);

#Alternatif
Route::resource('alternatif', AlternatifController::class)->middleware(['auth']);
#Hapus Semua Data Alternatif
Route::post('/alternatif/hapus_semua',  [AlternatifController::class, 'hapusSemua'])->middleware(['auth'])->name('alternatif.hapus_semua');


#Register
Route::resource('register', RegisterController::class)->middleware(['auth', 'admin']);

#nilaiIntensitas
Route::resource('nilaiIntensitas', IntensitasController::class)->middleware(['auth']);

#perhitungan
Route::resource('perhitungan', PerhitunganController::class)->middleware(['auth']);
Route::get('/proses', 'App\Http\Controllers\PerhitunganController@proses')->name('perhitungan.proses')->middleware(['auth']);

#Hasil
Route::get('/hasil', [HasilController::class, 'index'])->middleware(['auth'])->name('hasil');
Route::get('/hasil/cetak', [HasilController::class, 'cetak'])->middleware(['auth'])->name('hasil.cetak');
Route::get('/hasil/cetak/dwonload', [HasilController::class, 'pdfDwonload'])->middleware(['auth'])->name('hasil.pdfDwonload');
Route::get('/hasil/excel', [HasilController::class, 'excel'])->middleware(['auth'])->name('hasil.excel');
Route::get('/hasil/excel/dwonload', [HasilController::class, 'excelDwonload'])->middleware(['auth'])->name('hasil.excelDwonload');
Route::get('/hasil/cari', [HasilController::class, 'cari'])->middleware(['auth'])->name('hasil.cari');

//About
Route::resource('about', AboutController::class)->middleware(['auth']);

//Backup
Route::post('/cadangkan', [BackupController::class, 'cadangkanAlternatif'])->middleware(['auth'])->name('cadangkan');
Route::get('/cadangkan', [HistoryController::class, 'riwayat'])->middleware(['auth'])->name('riwayat');
Route::get('/cadangan-alternatif', [HistoryController::class, 'riwayatAlternatif'])->middleware(['auth'])->name('riwayat.tampil');

//Upload JSON
Route::get('/upload', [BackupController::class, 'upload'])->middleware(['auth'])->name('upload.form');
Route::post('/upload/file', [BackupController::class, 'uploadAlternatif'])->middleware(['auth'])->name('uploadFile');

#Profil
Route::resource('profil', ProfilController::class)->middleware(['auth']);
