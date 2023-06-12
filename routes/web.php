<?php

use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Fees\FeeController;
use App\Http\Controllers\Fees\FeesInvoicesController;
use App\Http\Controllers\Levels\LevelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Students\AttendanceController;
use App\Http\Controllers\Students\GraduateController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Teachers\TeacherController;
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
        return view('auth.login');
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

    /**** ROUTE FOR Teachers  ****/
        Route::resource('teachers', TeacherController::class);

    /**** ROUTE FOR Students  ****/

    Route::controller(StudentController::class)->group(function () {

        Route::resource('Students', StudentController::class);
        Route::post('upload_Attachment', [StudentController::class, 'upload_Attachment'])->name('upload_Attachment');
        Route::get('Download_attachment/{studentname}/{filename}', [StudentController::class, 'Download_attachment'])->name('Download_attachment');
        Route::get('open_attachment/{studentname}/{filename}', [StudentController::class, 'open_attachment'])->name('open_attachment');
        Route::post('Delete_attachment', [StudentController::class, 'Delete_attachment'])->name('Delete_attachment');
        // AJAX
        Route::get('/Get_classrooms/{id}', [StudentController::class, 'Get_classrooms']);
        Route::get('/Get_Sections/{id}', [StudentController::class, 'Get_Sections']);

        Route::resource('Attendance', AttendanceController::class);
    });

    Route::controller(PromotionController::class)->group(function () {

        Route::resource('Promotion', PromotionController::class);
    });

    Route::controller(GraduateController::class)->group(function () {
        Route::get('AddGraduate', [GraduateController::class, 'AddGraduate'])->name('AddGraduate');
        Route::post('graduated', [GraduateController::class, 'graduated'])->name('graduated');
        Route::get('showGraduated', [GraduateController::class, 'showGraduated'])->name('showGraduated');
        Route::post('restore', [GraduateController::class, 'restore'])->name('restore');
        Route::post('forceDelete', [GraduateController::class, 'forceDelete'])->name('forceDelete');

    });

    Route::controller(FeeController::class)->group(function () {
        Route::resource('Fees', FeeController::class);
    });

    Route::controller(FeesInvoicesController::class)->group(function () {
        Route::resource('Fees_Invoices', FeesInvoicesController::class);
    });



    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});
require __DIR__.'/auth.php';

