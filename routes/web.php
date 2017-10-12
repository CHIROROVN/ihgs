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
	//Users
	Route::get('/users', ['as' => 'backend.users.index', 'uses' => 'UsersController@index']);
	Route::get('/users/regist', ['as' => 'backend.users.regist', 'uses' => 'UsersController@regist']);
	Route::post('/users/regist', ['as' => 'backend.users.regist', 'uses' => 'UsersController@postRegist']);
	Route::get('/users/detail/{id}', ['as' => 'backend.users.detail', 'uses' => 'UsersController@detail']);
	Route::get('/users/edit/{id}', ['as' => 'backend.users.edit', 'uses' => 'UsersController@edit']);
	Route::post('/users/edit/{id}', ['as' => 'backend.users.edit', 'uses' => 'UsersController@postEdit']);
	Route::get('/users/delete/{id}', ['as' => 'backend.users.delete', 'uses' => 'UsersController@delete']);

	//Pc format
	Route::get('/pc/format', ['as' => 'backend.pc.format', 'uses' => 'PcFormatController@format']);
	Route::post('/pc/format', ['as' => 'backend.pc.format', 'uses' => 'PcFormatController@postFormat']);

	//Pc import
	Route::get('/pc/import', ['as' => 'backend.pc.import', 'uses' => 'PcController@import']);
	Route::post('/pc/import', ['as' => 'backend.pc.import', 'uses' => 'PcController@postImport']);

	//Working Time
	Route::get('/overwork', ['as' => 'backend.workingtime.index', 'uses' => 'WorkingTimeController@index']);
	Route::get('/overtime-detail', ['as' => 'backend.workingtime.detail', 'uses' => 'WorkingTimeController@detail']);

	 //division
    Route::get('/division', ['as' => 'backend.division.index', 'uses' => 'DivisionController@index']);
    Route::get('/division/regist', ['as' => 'backend.division.regist', 'uses' => 'DivisionController@getRegist']);
    Route::post('/division/regist', ['as' => 'backend.division.regist', 'uses' => 'DivisionController@postRegist']);
	Route::get('/division/edit/{id}', ['as' => 'backend.division.edit', 'uses' => 'DivisionController@getEdit']);
	Route::post('/division/edit/{id}', ['as' => 'backend.division.edit', 'uses' => 'DivisionController@postEdit']);
	Route::get('/division/delete/{id}', ['as' => 'backend.division.delete', 'uses' => 'DivisionController@getDelete']);
	Route::get('/division/orderby-top', ['as' => 'backend.division.orderby.top', 'uses' => 'DivisionController@orderby_top']);
	Route::get('/division/orderby-last', ['as' => 'backend.division.orderby.last', 'uses' => 'DivisionController@orderby_last']);
	Route::get('/division/orderby-up', ['as' => 'backend.division.orderby.up', 'uses' => 'DivisionController@orderby_up']);
	Route::get('/division/orderby-down', ['as' => 'backend.division.orderby.down', 'uses' => 'DivisionController@orderby_down']);
    //section
	Route::get('section/{parent_id}', ['as' => 'backend.section.index', 'uses' => 'SectionController@index']);
	Route::get('section/{parent_id}/regist', ['as' => 'backend.section.regist', 'uses' => 'SectionController@getRegist']);
	Route::post('section/{parent_id}/regist', ['as' => 'backend.section.regist', 'uses' => 'SectionController@postRegist']);
	Route::get('section/{parent_id}/edit/{id}', ['as' => 'backend.section.edit', 'uses' => 'SectionController@getEdit']);
	Route::post('section/{parent_id}/edit/{id}', ['as' => 'backend.section.edit', 'uses' => 'SectionController@postEdit']);
	Route::get('section/{parent_id}/delete/{id}', ['as' => 'backend.section.delete', 'uses' => 'SectionController@getDelete']);
	Route::get('section/{parent_id}/orderby-top', ['as' => 'backend.division.orderby.top', 'uses' => 'DivisionController@orderby_top']);
	Route::get('section/{parent_id}/orderby-last', ['as' => 'backend.division.orderby.last', 'uses' => 'DivisionController@orderby_last']);
	Route::get('section/{parent_id}/orderby-up', ['as' => 'backend.division.orderby.up', 'uses' => 'DivisionController@orderby_up']);
	Route::get('section/{parent_id}/orderby-down', ['as' => 'backend.division.orderby.down', 'uses' => 'DivisionController@orderby_down']);
    //timecard
    Route::get('/timecard', ['as' => 'backend.timecard.index', 'uses' => 'TimecardController@index']);
    Route::post('timecard/import', ['as' => 'backend.timecard.import', 'uses' => 'TimecardController@import']);
    Route::get('/timecard/regist', ['as' => 'backend.timecard.regist', 'uses' => 'TimecardController@getRegist']); 
    Route::post('/timecard/regist', ['as' => 'backend.timecard.regist', 'uses' => 'TimecardController@postRegist']); 
    Route::get('/timecard/edit/{id}', ['as' => 'backend.timecard.edit', 'uses' => 'TimecardController@getEdit']); 
    Route::post('/timecard/edit/{id}', ['as' => 'backend.timecard.edit', 'uses' => 'TimecardController@postEdit']); 
    Route::get('/timecard/delete/{dataname}', ['as' => 'backend.timecard.delete', 'uses' => 'TimecardController@getDelete']);
    //door
    Route::get('/door', ['as' => 'backend.door.index', 'uses' => 'DoorController@index']);
    Route::post('/door/import', ['as' => 'backend.door.import', 'uses' => 'DoorController@importDoorcard']);
    Route::get('/door/regist', ['as' => 'backend.door.regist', 'uses' => 'DoorController@getRegist']);
    Route::post('/door/regist', ['as' => 'backend.door.regist', 'uses' => 'DoorController@postRegist']);
    Route::get('/door/delete/{dataname}', ['as' => 'backend.door.delete', 'uses' => 'DoorController@getDelete']);
    Route::get('/door/edit/{id}', ['as' => 'backend.door.edit', 'uses' => 'DoorController@getEdit']); 
    Route::post('/door/edit/{id}', ['as' => 'backend.door.edit', 'uses' => 'DoorController@postEdit']); 

    Route::get('/staff', ['as' => 'backend.staff.index', 'uses' => 'StaffController@index']);
    Route::get('/staff/regist', ['as' => 'backend.staff.regist', 'uses' => 'StaffController@getRegist']);
    Route::post('/staff/regist', ['as' => 'backend.staff.regist', 'uses' => 'StaffController@postregist']);
    Route::get('/staff/import', ['as' => 'backend.staff.import', 'uses' => 'StaffController@getImport']);
    Route::post('/staff/import', ['as' => 'backend.staff.import', 'uses' => 'StaffController@postImport']);

	Route::get('/staff/search', ['as' => 'backend.staff.search', 'uses' => 'StaffController@search']);
	Route::post('/staff/search', ['as' => 'backend.staff.search', 'uses' => 'StaffController@index']);
	Route::get('/staff/delete/{id}', ['as' => 'backend.staff.delete', 'uses' => 'StaffController@getDelete']);
	Route::get('/staff/edit/{id}', ['as' => 'backend.staff.edit', 'uses' => 'StaffController@getEdit']);
	Route::post('/staff/edit/{id}', ['as' => 'backend.staff.edit', 'uses' => 'StaffController@postEdit']);

});

Route::get('/', function(){
	return redirect()->route('auth.login');
});

Route::get('/users/login', function(){
	return redirect()->route('auth.login');
});

if(Auth::check()){
	return redirect()->route('backend.search.index');
}else{
	return redirect()->route('auth.login');
}
