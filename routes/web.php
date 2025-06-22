<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Laporan\Index as LaporanIndex;
use App\Livewire\Kegiatan\Index as KegiatanIndex;
use App\Livewire\Kegiatan\AturPanitia;
use App\Livewire\Anggota\Index as AnggotaIndex;
use App\Livewire\Organisasi\Index as OrganisasiIndex;
use App\Livewire\Lokasi\Index as LokasiIndex;


Route::get('/', LaporanIndex::class)->name('laporan');

Route::prefix('kegiatan')->name('kegiatan.')->group(function () {
    Route::get('/', KegiatanIndex::class)->name('index');
    Route::get('/{kegiatan}/panitia', AturPanitia::class)->name('panitia');
});

Route::get('/anggota', AnggotaIndex::class)->name('anggota.index');

Route::get('/organisasi', OrganisasiIndex::class)->name('organisasi.index');

Route::get('/lokasi', LokasiIndex::class)->name('lokasi.index');