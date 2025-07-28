<?php

use App\Livewire\Tasks\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/tasks', Index::class);
