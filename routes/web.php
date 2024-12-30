<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BioController;


Route::get('/', function () {
    //return view('auth.login');
    return view('home.index');
});

Route::get('/login', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/user/{id}', [ProfileController::class, 'view'])->name('user.profile.view');
Route::get('/user_two/{id}', [ProfileController::class, 'view_two'])->name('user.profile.view_two');
Route::get('/user_three/{id}', [ProfileController::class, 'view_three'])->name('user.profile.view_three');
Route::get('/user_four/{id}', [ProfileController::class, 'view_four'])->name('user.profile.view_four');
Route::get('/download-pdf/{id}', [ProfileController::class, 'downloadPDF'])->name('download-pdf');
Route::get('/download-pdf-two/{id}', [ProfileController::class, 'downloadPDFTwo'])->name('download-pdf-two');
Route::get('/download-pdf-three/{id}', [ProfileController::class, 'downloadPDFThree'])->name('download-pdf-three');
Route::get('/download-pdf-four/{id}', [ProfileController::class, 'downloadPDFFour'])->name('download-pdf-four');

Route::get('/bio/{id}', [BioController::class, 'view'])->name('bio.view');
Route::get('/bio-two/{id}', [BioController::class, 'view_two'])->name('bio.view_two');
Route::get('/bio-three/{id}', [BioController::class, 'view_three'])->name('bio.view_three');
Route::get('/bio-four/{id}', [BioController::class, 'view_four'])->name('bio.view_four');
Route::get('/bio/download-pdf/{id}', [BioController::class, 'downloadPDF'])->name('download-pdf-bio');
Route::get('/bio/download-pdf-two/{id}', [BioController::class, 'downloadPDFTwo'])->name('download-pdf-two-bio');
Route::get('/bio/download-pdf-three/{id}', [BioController::class, 'downloadPDFThree'])->name('download-pdf-three-bio');
Route::get('/bio/download-pdf-four/{id}', [BioController::class, 'downloadPDFFour'])->name('download-pdf-four-bio');


Route::group(['middleware' => ['auth']], function () {

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/my-profile', [ProfileController::class, 'index'])->name('index');

    Route::get('/create', [ProfileController::class, 'create'])->name('user.profile.create');
    Route::post('/store', [ProfileController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('edit');
    Route::post('/update', [ProfileController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [ProfileController::class, 'destroy'])->name('destroy');

    Route::get('/my-bio', [BioController::class, 'index'])->name('bio.index');

    Route::get('/my-bio/create', [BioController::class, 'create'])->name('bio.create');
    Route::post('/my-bio/store', [BioController::class, 'store'])->name('bio.store');
    Route::get('/my-bio/edit/{id}', [BioController::class, 'edit'])->name('bio.edit');
    Route::post('/my-bio/update', [BioController::class, 'update'])->name('bio.update');
    Route::delete('/my-bio/destroy/{id}', [BioController::class, 'destroy'])->name('bio.destroy');



});
