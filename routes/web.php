<?php

use App\Livewire\SppTable;
use App\Livewire\CreatePenawaran;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CetakSppController;


Route::get('/spp', SppTable::class)->name('spp.index');
Route::get('/', CreatePenawaran::class)->name('home');
Route::get('/spp/{id}/cetak', [CetakSppController::class, 'cetak'])->name('spp.cetak');
