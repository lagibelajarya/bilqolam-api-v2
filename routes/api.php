<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\guruController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\lembagaController;
use App\Http\Controllers\santriController;
use App\Http\Controllers\userController;
use App\Http\Controllers\wilayahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [authController::class, 'login']);
Route::post('/register', [authController::class, 'register']);
Route::get('/login-page-data', [authController::class, 'loginPageData']);
Route::get('/make-user', [authController::class, 'make']);
Route::post('/select-wilayah', [wilayahController::class, 'selectWilayah']);

Route::get('/unauthorized', function () {
    return response()->json([
        'status' => false,
        'message' => 'Unauthorized User'
    ], 401);
})->name('unauthorized');
Route::middleware('auth:api')->group(function () {
    // lembaga 
    Route::get('/get-lembaga', [lembagaController::class, 'index']);
    Route::post('/create-lembaga', [lembagaController::class, 'createLembaga']);
    Route::post('/show-lembaga/{id}', [lembagaController::class, 'showLembaga']);
    Route::post('/update-lembaga/{id}', [lembagaController::class, 'updateLembaga']);
    Route::delete('/delete-lembaga/{id}', [lembagaController::class, 'deleteLembaga']);
    //select wilayah 
    Route::post('/logout', [authController::class, 'logout']);

    //dashboard
    Route::get('/dashboard', [dashboardController::class, 'index']);
    // guru
    Route::get('/get-guru', [guruController::class, 'index']);
    Route::post('/create-guru', [guruController::class, 'createGuru']);
    Route::post('/show-guru/{id}', [guruController::class, 'showGuru']);
    Route::post('/update-guru', [guruController::class, 'updateGuru']);
    Route::delete('/delete-guru/{id}', [guruController::class, 'deleteGuru']);
    // santri
    Route::get('/get-santri', [santriController::class, 'index']);
    Route::post('/show-santri/{id}', [santriController::class, 'showSantri']);
    Route::post('/create-santri', [santriController::class, 'createSantri']);
    Route::post('/update-santri', [santriController::class, 'updateSantri']);
    Route::delete('/delete-santri/{id}', [santriController::class, 'deleteSantri']);

    // laporan
    Route::get('lembaga-provinsi/{keyWilayah}', [laporanController::class, 'getLembagaProv']);
    Route::get('lembaga-wilayah-detail/{wilayah}', [laporanController::class, 'getLembagaDetail']);
    Route::get('lembaga-wilayah/{keyWilayah}/{wilayah}', [laporanController::class, 'getLembagaWilayah']);
    Route::get('guru-wilayah/{keyWilayah}/{wilayah}', [laporanController::class, 'getGuruWilayah']);
    Route::get('santri-wilayah/{keyWilayah}/{wilayah}', [laporanController::class, 'getSantriWilayah']);
    Route::get('lembaga-formal-wilayah/{keyWilayah}/{wilayah}', [laporanController::class, 'getLembagaFormalWilayah']);
    Route::get('lembaga-nonformal-wilayah/{keyWilayah}/{wilayah}', [laporanController::class, 'getLemagaNonFormalWilayah']);

    //user
    Route::post('/update-user', [userController::class, 'updateUser']);
});
