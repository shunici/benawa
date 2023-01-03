<?php

use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function(){
//     return view ('index');
// });


Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');

// Route::get('/', 'spkController@index');

