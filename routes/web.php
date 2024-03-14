<?php

use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return redirect('/app');
});

Route::get('/login', static function () {
    return redirect('/app/login');
})->name('login');
