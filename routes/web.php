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


Auth::routes();

Route::group(['prefix' => '', 'namespace' => 'Backend'], function () {
	/*
	|--------------------------------------------------------------------------
	| Backend home page
	|--------------------------------------------------------------------------
	*/
	Route::get('/static_search', ['as' => 'backend.search.index', 'uses' => 'SearchController@index']);
	Route::get('/login', ['as' => 'auth.login', 'uses' => 'UsersController@login']);
	Route::post('/login', ['as' => 'auth.login', 'uses' => 'UsersController@postLogin']);
	Route::get('/logout', ['as' => 'auth.logout', 'uses' => 'UsersController@logout']);

	

});

Route::get('/', function(){
	return redirect()->route('auth.login');
});

if(Auth::check()){
	return redirect()->route('backend.search.index');
}
