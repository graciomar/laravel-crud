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
	if (Auth::check()) {
		return view('home');
	}else{
		return redirect()->route('login');
	}
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Routes for Crud
|--------------------------------------------------------------------------
*/
Route::name('crud.')->prefix('crud')->group(function () {
    Route::get('/index', 'CrudController@index')->name('index');
    Route::get('/create', 'CrudController@create')->name('create');
    Route::post('/store', 'CrudController@store')->name('store');
    Route::get('/show/{id}', 'CrudController@show')->name('show');
    Route::get('/edit/{id}', 'CrudController@edit')->name('edit');
    Route::post('/update', 'CrudController@update')->name('update');
    Route::delete('/destroy/{id}', 'CrudController@destroy')->name('destroy');
});