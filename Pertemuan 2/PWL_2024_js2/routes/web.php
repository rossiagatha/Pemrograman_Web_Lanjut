<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
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

/* Basic Parameter */
Route::get('/', function () {
    return view('welcome');
});

/*wellcome Controller*/
Route::get('/hello', [WelcomeController::class, 'hello'] );
Route::get('/index', [PageController::class, 'index'] );
Route::get('/about', [PageController::class, 'about'] );
Route::get('/articles/{id}', [PageController::class, 'articles'] );

/*resource  Controller*/
Route::resource('photos', PhotoController::class) ->only(['index', 'show']);
Route::resource('photos', PhotoController::class) ->except(['create', 'store', 'update', 'destroy']);

/*View*/
/*Route::get('/greeting', function() {
    return view('blog.hello', ['name' => 'Rossi']);
});*/
Route::get('/greeting', [WelcomeController::class, 'greeting']);

Route::get('/world', function () {
    return ('World');
});

/* Route::get('/', function () {
     return ('Selamat Datang');
}); */

/* Route::get('/about', function () {
    return ('NIM 2141762112 , Nama Rossi Dea Agatha');
}); */

/* Route Parameter*/
Route::get('/user/{Rossi}', function ($name) {
    return ('Nama saya '.$name);
});

/*Regular Expression */
Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return ('Post ke- '.$postId. " Komentar ke-: ".$commentId);
});

/* Route::get('/articles/{id}', function ($id) {
    return ('Halaman Artikel dengan ID '.$id);
}); */

/*Optional Parameter */
Route::get('/user/{Rossi?}', function ($name=null) {
    return ('Nama saya '.$name);
});

Route::get('/user/{name?}', function ($name='John') {
    return ('Nama saya '.$name);
});

/*Fungsi dd() */
/* Route::get('/hello', function () {
    $hello = ['Hello World', 2 => ['Hello Jakarta', 'Hello Medan']];
    dd($hello);

    return $hello;
}); */

/*var dumb dan die */
/* Route::get('/hello', function () {
    $hello = 'Hello World';
    var_dump($hello);
    die();

    return $hello;
}); */

/*mahasiswa */
/* Route::get('/mahasiswa', function () {
    //$arrMahasiswa = ["Risa Lesatri", "Rudi Hermawan", "Bambang Kusumo", "Lisa Permata"];

    //return view ("polinema.mahasiswa", ['mahasiswa'=> $arrMahasiswa]);
}); */