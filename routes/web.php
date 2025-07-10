<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', function () {
    echo("Welcome page.");
});



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
