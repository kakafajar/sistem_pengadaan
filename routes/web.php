<?php

use App\Livewire\SppTable;
use App\Livewire\CreatePenawaran;
use Illuminate\Support\Facades\Route;


Route::get('/spp', SppTable::class)->name('spp.index');
Route::get('/', CreatePenawaran::class)->name('home');
