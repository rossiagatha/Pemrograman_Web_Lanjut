<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
Route::get('user/tambah', [UserController::class, 'tambah']);
Route::post('user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::get('/kategori', [KategoriController::class, 'index']);

Route::get('/kategori/create', [KategoriController::class, 'create']);
Route::get('/kategori', [KategoriController::class, 'store']); */



Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.auth');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/storeMember', [LoginController::class, 'storeMember'])->name('register.auth');


Route::middleware(['auth'])->group(
    function () {
        Route::get('/', [WelcomeController::class,'index'])->name('dashboard');
        
        Route::group(['prefix' => 'dashboard'], function () {
       
        Route::get('/exportPdf', [WelcomeController::class,'exportPdf'])->name('exportPdf');
        Route::get('/exportExcel', [WelcomeController::class,'exportExcel'])->name('exportExcel');
        Route::put('/validateUser/{id}', [WelcomeController::class, 'validateStatus'])->name('validateStatus');
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index']);
            Route::post('list', [UserController::class, 'list']);
            Route::get('/create', [UserController::class, 'create']);
            Route::post('/', [UserController::class, 'store']);
            Route::get('/{id}', [UserController::class, 'show']);
            Route::get('/{id}/edit', [UserController::class, 'edit']);
            Route::put('/{id}', [UserController::class, 'update']);
            Route::delete('/{id}', [UserController::class, 'destroy']);
            Route::post('/user/{id}', [UserController::class, 'validateUser'])->name('validate.user');
            

        });
        
        Route::group(['prefix' => 'barang'], function () {
            Route::get('/', [BarangController::class, 'index']);
            Route::post('list', [BarangController::class, 'list']);
            Route::get('/create', [BarangController::class, 'create']);
            Route::post('/', [BarangController::class, 'store']);
            Route::get('/{id}/edit', [BarangController::class, 'edit']);
            Route::get('/{id}', [BarangController::class, 'show']);
            Route::put('/{id}', [BarangController::class, 'update']);
            Route::delete('/{id}', [BarangController::class, 'destroy']);
        
        });
        
        Route::group(['prefix' => 'kategori'], function () {
            Route::get('/', [KategoriController::class, 'index']);
            Route::post('/list', [KategoriController::class, 'list']);
            Route::get('/create', [KategoriController::class, 'create']);
            Route::get('/{id}/edit', [KategoriController::class, 'edit']);
            Route::get('/{id}', [KategoriController::class, 'show']);
            Route::post('/', [KategoriController::class, 'store']);
            Route::put('/{id}', [KategoriController::class, 'update']);
            Route::delete('/{id}', [KategoriController::class, 'destroy']);
        
        });
        
        
        Route::group(['prefix' => 'level'], function () {
            Route::get('/', [LevelController::class, 'index']);
            Route::post('/list', [LevelController::class, 'list']);
            Route::get('/create', [LevelController::class, 'create']);
            Route::put('/{id}', [LevelController::class, 'update']);
            Route::get('/{id}/edit', [LevelController::class, 'edit']);
            Route::get('/{id}', [LevelController::class, 'show']);
            Route::post('/', [LevelController::class, 'store']);
            Route::put('/{id}', [LevelController::class, 'update']);
            Route::delete('/{id}', [LevelController::class, 'destroy']);
        
        });
        
        Route::group(['prefix' => 'stok'], function () {
            Route::get('/', [StokController::class, 'index']);
            Route::post('/list', [StokController::class, 'list']);
            Route::get('/create', [StokController::class, 'create']);
            Route::put('/{id}', [StokController::class, 'update']);
            Route::get('/{id}/edit', [StokController::class, 'edit']);
            Route::get('/{id}', [StokController::class, 'show']);
            Route::post('/', [StokController::class, 'store']);
            Route::put('/{id}', [StokController::class, 'update']);
            Route::delete('/{id}', [StokController::class, 'destroy']);
        
        });
        
        Route::group(['prefix' => 'riwayat'], function () {
            Route::get('/', [RiwayatController::class, 'index']);
            Route::post('/list', [RiwayatController::class, 'list']);
            Route::get('/create', [RiwayatController::class, 'create']);
            Route::put('/{id}', [RiwayatController::class, 'update']);
            Route::get('/{id}/edit', [RiwayatController::class, 'edit']);
            Route::get('/{id}', [RiwayatController::class, 'show']);
            Route::post('/', [RiwayatController::class, 'store']);
            Route::put('/{id}', [RiwayatController::class, 'update']);
            Route::delete('/{id}', [RiwayatController::class, 'destroy']);
        
        });        
    }
);


