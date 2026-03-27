<?php

use App\Livewire\SppTable;
use App\Livewire\CreatePenawaran;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CetakSppController;
use App\Livewire\DataMitra;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Auth;


Route::get('/login', Login::class)->name('login')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/', CreatePenawaran::class)->name('home');
    Route::get('/spp', SppTable::class)->name('spp.index');
    Route::get('/spp/{id}/cetak', [CetakSppController::class, 'cetak'])->name('spp.cetak');
    Route::get('/preview-surat', App\Livewire\PreviewSurat::class)->name('preview.surat');
    Route::get('/data-mitra', DataMitra::class)->name('mitra.index');

    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});
