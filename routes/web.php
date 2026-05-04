<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\SummaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(ModelController::class)->group(function () {

    Route::get('/models', 'index')->name('models.index');
    Route::get('/models/{slug}', 'show')->name('models.show');
    Route::post('/models/{key}/summarize', 'summarize')->name('models.summarize');

});

Route::get('/test', function () {
    return view('test');
});
// Route::controller(SummaryController::class)->group(function () {

//     // Package-based summarization
//     Route::get('/summary/package', 'packageForm')->name('summary.package.form');
//     Route::post('/summary/package', 'packageSummary')->name('summary.package');

//     // API-based summarization
//     Route::get('/summary/api', 'apiForm')->name('summary.api.form');
//     Route::post('/summary/api', 'apiSummary')->name('summary.api');

// });

