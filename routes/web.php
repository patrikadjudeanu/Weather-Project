<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/logout', function(){

    Auth::logout();
    
    return redirect('/welcome');
})->name('logout');

Route::get('/', 'HomeController@index')->name('home');

Route::match(['get', 'post'], '/temperature', 'TemperatureController@index')->name('temperature');

Route::match(['get', 'post'], '/statistics', 'StatisticsController@index')->name('statistics');


