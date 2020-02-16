<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Ambil Semua Data Kucing
Route::get('kucing', 'KucingController@index');

// Membuat Data Kucing Baru
Route::post('kucing', 'KucingController@store');

// Mengambil Satu Data Kucing
Route::get('kucing/{id}', 'KucingController@show');

// Mengubah Kucing
Route::put('kucing/{id}', 'KucingController@update');

// Menghapus Kucing
Route::delete('kucing/{id}', 'KucingController@destroy');
