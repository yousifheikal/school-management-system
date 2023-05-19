<?php

use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Levels\LevelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Sections\SectionController;
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

    /**** ROUTE FOR ClassroomController ****/
    Route::resource('classrooms',  ClassroomController::class);
    Route::delete('delete_selected', [ClassroomController::class, 'delete_selected'])->name('delete_selected');
    Route::post('filter_classes', [ClassroomController::class, 'filter'])->name('filter');

    /**** ROUTE FOR SectionController ****/
    Route::resource('Sections', SectionController::class);
    //get data of classes with Ajax
    Route::get('/classes/{id}', [SectionController::class, 'getClasses']) ;

    /**** ROUTE FOR live-wire Add-Parent  ****/
    Route::view('add_parent', 'livewire.show_Form')->name('add_parent');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});
require __DIR__.'/auth.php';

