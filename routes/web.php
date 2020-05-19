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
    Route::get('/index', 'ClientController@index')->name('index');
    Route::get('/create', 'ClientController@create')->name('create');
    Route::post('/store', 'ClientController@store')->name('store');
    Route::get('/show/{id}', 'ClientController@show')->name('show');
    Route::patch('/edit/{id}', 'ClientController@edit')->name('edit');
    Route::delete('/destroy/{id}', 'ClientController@destroy')->name('destroy');
});