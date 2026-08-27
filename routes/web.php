<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\RumahController;
use App\Http\Controllers\IplController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\BeritaAcaraController;
use App\Http\Controllers\SuratUndanganController;
use App\Http\Controllers\SuratKeluarController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------
    | Admin/Pengurus RT
    |--------------------------------------------------------------------
    */
    Route::middleware('role:Admin')->group(function () {

        Route::controller(WargaController::class)->prefix('warga')->group(function () {
            Route::get('', 'index')->name('warga');
            Route::get('add', 'add')->name('warga.add');
            Route::post('add', 'save')->name('warga.save');
            Route::get('edit/{id}', 'edit')->name('warga.edit');
            Route::post('edit/{id}', 'update')->name('warga.update');
            Route::get('delete/{id}', 'delete')->name('warga.delete');
        });

        Route::controller(RumahController::class)->prefix('rumah')->group(function () {
            Route::get('', 'index')->name('rumah');
            Route::get('add', 'add')->name('rumah.add');
            Route::post('add', 'save')->name('rumah.save');
            Route::get('edit/{id}', 'edit')->name('rumah.edit');
            Route::post('edit/{id}', 'update')->name('rumah.update');
            Route::get('delete/{id}', 'delete')->name('rumah.delete');
        });

        Route::controller(IplController::class)->prefix('ipl')->group(function () {
            Route::get('', 'index')->name('ipl');
            Route::get('add', 'add')->name('ipl.add');
            Route::post('add', 'save')->name('ipl.save');
            Route::get('edit/{id}', 'edit')->name('ipl.edit');
            Route::post('edit/{id}', 'update')->name('ipl.update');
            Route::get('delete/{id}', 'delete')->name('ipl.delete');
        });

        Route::controller(PembayaranController::class)->prefix('pembayaran')->group(function () {
            Route::get('', 'index')->name('pembayaran');
            Route::get('{id}', 'show')->name('pembayaran.show');
            Route::post('{id}/verifikasi', 'verifikasi')->name('pembayaran.verifikasi');
        });

        Route::controller(BeritaAcaraController::class)->prefix('berita-acara')->group(function () {
            Route::get('', 'index')->name('berita-acara');
            Route::get('add', 'add')->name('berita-acara.add');
            Route::post('add', 'save')->name('berita-acara.save');
            Route::get('edit/{id}', 'edit')->name('berita-acara.edit');
            Route::post('edit/{id}', 'update')->name('berita-acara.update');
            Route::get('delete/{id}', 'delete')->name('berita-acara.delete');
        });

        Route::controller(SuratUndanganController::class)->prefix('surat-undangan')->group(function () {
            Route::get('', 'index')->name('surat-undangan');
            Route::get('add', 'add')->name('surat-undangan.add');
            Route::post('add', 'save')->name('surat-undangan.save');
            Route::get('edit/{id}', 'edit')->name('surat-undangan.edit');
            Route::post('edit/{id}', 'update')->name('surat-undangan.update');
            Route::get('delete/{id}', 'delete')->name('surat-undangan.delete');
            Route::get('cetak/{id}', 'cetak')->name('surat-undangan.cetak');
        });

        Route::controller(SuratKeluarController::class)->prefix('surat-keluar')->group(function () {
            Route::get('', 'index')->name('surat-keluar');
            Route::get('add', 'add')->name('surat-keluar.add');
            Route::post('add', 'save')->name('surat-keluar.save');
            Route::get('edit/{id}', 'edit')->name('surat-keluar.edit');
            Route::post('edit/{id}', 'update')->name('surat-keluar.update');
            Route::get('delete/{id}', 'delete')->name('surat-keluar.delete');
        });

        Route::post('surat/{id}/proses', [SuratController::class, 'proses'])->name('surat.proses');
    });

    /*
    |--------------------------------------------------------------------
    | Warga
    |--------------------------------------------------------------------
    */
    Route::middleware('role:Warga')->group(function () {
        Route::get('tagihan-saya', [IplController::class, 'tagihanSaya'])->name('ipl.tagihan-saya');

        Route::get('bayar/{iplId}', [PembayaranController::class, 'bayar'])->name('pembayaran.bayar');
        Route::post('bayar/{iplId}', [PembayaranController::class, 'bayarSave'])->name('pembayaran.bayar.save');

        Route::get('surat/create', [SuratController::class, 'create'])->name('surat.create');
        Route::post('surat/create', [SuratController::class, 'store'])->name('surat.store');
    });

    /*
    |--------------------------------------------------------------------
    | Bersama (Admin & Warga) - Pengajuan Surat
    |--------------------------------------------------------------------
    */
    Route::controller(SuratController::class)->prefix('surat')->group(function () {
        Route::get('', 'index')->name('surat');
        Route::get('{id}', 'show')->name('surat.show');
        Route::get('{id}/pdf', 'pdf')->name('surat.pdf');
    });
});
