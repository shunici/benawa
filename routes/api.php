<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::prefix('produk/')->group(function(){
    Route::get('/', 'produkController@index');
    Route::post('/create', 'produkController@create');
    Route::get('/edit/{id}', 'produkController@edit');
    Route::post('/update/{id}', 'produkController@update');
    Route::delete('/delete/{id}', 'produkController@delete');
});

Route::prefix('bahan/')->group(function(){
    Route::get('/', 'bahanController@index');
    Route::post('/create', 'bahanController@create');
    Route::get('/edit/{id}', 'bahanController@edit');
    Route::post('/update/{id}', 'bahanController@update');
    Route::delete('/delete/{id}', 'bahanController@delete');
    Route::get('/total', 'bahanController@total');
});

Route::prefix('data_spk/')->group(function(){
    Route::get('/', 'data_spkController@index');
    Route::post('/create', 'data_spkController@create');
    Route::get('/edit/{id}', 'data_spkController@edit');
    Route::post('/update/{id}', 'data_spkController@update');
    Route::delete('/delete/{id}', 'data_spkController@delete');
});


Route::prefix('pemesan/')->group(function(){
    Route::get('/', 'pemesanController@index');
    Route::post('/create', 'pemesanController@create');
    Route::get('/edit/{id}', 'pemesanController@edit');
    Route::post('/update/{id}', 'pemesanController@update');
    Route::delete('/delete/{id}', 'pemesanController@delete');
});


Route::resource('/label', 'labelController')->except(['show', 'update']);
Route::post('/label/update/{id}', 'labelController@update'); 


Route::resource('/alert', 'alertController')->except(['show', 'update']);
Route::post('/alert/update/{id}', 'alertController@update'); 
Route::get('/alert/cari/{id}', 'alertController@carialert');
Route::post('/gabung-alert', 'alertController@gabung');


Route::resource('/karyawan', 'karyawanController')->except(['show', 'update']);
Route::post('/karyawan/update/{id}', 'karyawanController@update'); 



Route::resource('/spk', 'spkController')->except(['show', 'update']);
Route::post('/spk/update/{id}', 'spkController@update');
Route::post('/gabung-spk', 'spkController@gabung');
Route::post('/spk-updatelabel', 'spkController@updatelabel');
Route::get('/ambil-warna', 'spkController@color');
Route::post('/spk/csd/{id}', 'spkController@csd');
Route::post('/spk/cs/{id}', 'spkController@cs');
Route::post('/spk-handlespk/{id}', 'spkController@handlespk');
Route::get('/query_data', 'spkController@queriData');
Route::post('/jadikan-csd', 'spkController@jadikancsd');

Route::resource('/agenda', 'agendaController')->except(['show', 'update']);
Route::post('/agenda/update/{id}', 'agendaController@update');
Route::post('/gabung-agenda', 'agendaController@gabung');

Route::get('/cari_pemesan', 'pemesanController@cari_pemesan');


Route::resource('/info', 'infoController')->except(['show', 'update']);
Route::post('/info/update/{id}', 'infoController@update'); 

