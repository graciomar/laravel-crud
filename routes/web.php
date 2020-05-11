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

/*begin routes for crud*/
Route::get('/crud/index', 'CrudController@index')->name('crud.index');
Route::get('/crud/create', 'CrudController@create')->name('crud.create');
Route::post('/crud/store', 'CrudController@store')->name('crud.store');
Route::post('/crud/update', 'CrudController@update')->name('crud.update');
Route::get('/crud/edit/{id}', 'CrudController@edit')->name('crud.edit');
Route::get('/crud/destroy/{id}', 'CrudController@destroy')->name('crud.destroy');
/*end routes for crud*/

Route::get('/teste', function () {
    $im = new Imagick( 'document.pdf[ 0]' ); 
    $im->setImageColorspace(255); 
    $im->setResolution(300, 300);
    $im->setCompressionQuality(95); 
    $im->setImageFormat('jpeg'); 
    $im->writeImage('thumb.jpg'); 
    $im->clear(); 
    $im->destroy();

	//return view('test');
	//return 'teste';
});