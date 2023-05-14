<?php

use App\Http\Controllers\Levels\LevelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**** CONDITION IF GUEST HAVE ACCESS TO VISIT PAGE, BUT AUTHENTICATION NOT VISIT THIS PAGE ****/
Route::group(['middleware' => ['guest']], function (){

    /**** ROUTE FOR LOGIN ****/
    Route::get('/', function () {
        return view('welcome');
    });
});


/**** ALL ROUTES TRANSLATED (ENGLISH - ARABIC) ****/
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth', 'verified' ]
    ], function(){


    /**** ROUTE FOR MAIN-PAGE CALL (DASHBOARD) IF U WANT VISIT THIS PAGE U SHOULD AUTH ****/
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /**** ROUTE FOR LevelController ****/
    Route::resource('levels', LevelController::class);


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});
require __DIR__.'/auth.php';

