<?php

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

Route::get('/', function () {
    return view('list');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/click','Click');
Route::get('/success/{click_id}',function($click_id){return 'success';})->name('success');
Route::get('/error/{click_id}', function($click_id){return view('timeout');})->name('error');
Route::get('getlist','Click@getListItems')->name('getlist');


Route::get('/bad', function () {
    return view('bad');
})->name('bad');
Route::get('getbad','Click@getBad')->name('getbad');
Route::post('bad','Click@storebad')->name('storebad');