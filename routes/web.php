<?php

use App\Livewire\Homepage;
use App\Livewire\Tryout;
use Illuminate\Support\Facades\Route;

Route::get('/', Homepage::class)->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/tryout/{id}',Tryout::class)->name('tryout.page');
});

