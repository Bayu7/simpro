<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;

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

Route::get('/', function () {
    return view('welcome');
});

//Pegawai
Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai');
//TambahPegawai
Route::get('/tambahpegawai', [PegawaiController::class, 'tambah_pegawai'])->name('tambahpegawai');
Route::post('/proses_insertpegawai', [PegawaiController::class, 'proses_insert_pegawai'])->name('proses_insertpegawai');
//EditPegawai
Route::get('/editpegawai/{id}', [PegawaiController::class, 'edit_pegawai'])->name('editpegawai');
Route::post('/proses_editpegawai/{id}', [PegawaiController::class, 'proses_edit_pegawai'])->name('proses_editpegawai');
//DeletePegawai
Route::get('/deletepegawai/{id}', [PegawaiController::class, 'delete_pegawai'])->name('deletepegawai');
//ExportPDF
Route::get('/exportpdfpegawai', [PegawaiController::class, 'exportpdf_pegawai'])->name('exportpdf_pegawai');
