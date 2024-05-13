<?php

use App\Http\Controllers\TempSubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return redirect('/app');
});

Route::get('/login', static function () {
    return redirect('/app/login');
})->name('login');


Route::get('/resources/xlsform-resource/{xlsform}/download-data-direct-from-odk', [TempSubmissionController::class, 'downloadDataDirectFromOdk'])->name('resources.xlsform-resource.download-data-direct-from-odk')
->middleware('auth:web');
