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
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	Route::get('roles', ['as' => 'roles.index', 'uses' => 'CustomUserRoleController@index']);
	Route::put('roles/store', ['as' => 'roles.store', 'uses' => 'CustomUserRoleController@store']);
	Route::delete('roles/{name}/delete', ['as' => 'roles.delete', 'uses' => 'CustomUserRoleController@delete']);

	Route::get('borrower', ['as' => 'borrower.index', 'uses' => 'BorrowerController@index']);
	Route::get('borrower/add', ['as' => 'borrower.create', 'uses' => 'BorrowerController@create']);
	Route::put('borrower/store', ['as' => 'borrower.add', 'uses' => 'BorrowerController@store']);
	Route::get('borrower/{borrower}', ['as' => 'borrower.view', 'uses' => 'BorrowerController@show']);
	Route::delete('borrower/{borrower}', ['as' => 'borrower.delete', 'uses' => 'BorrowerController@delete']);

	Route::get('loans', ['as' => 'loans.index', 'uses' => 'LoanController@index']);
	Route::put('loans/store', ['as' => 'loans.add', 'uses' => 'LoanController@store']);
	Route::get('loans/create', ['as' => 'loans.create', 'uses' => 'LoanController@create']);
	Route::get('loans/{loan}', ['as' => 'loans.view', 'uses' => 'LoanController@show']);
	Route::delete('loans/{loan}', ['as' => 'loans.delete', 'uses' => 'LoanController@destroy']);

	Route::get('payments',['as' => 'payments.index', 'uses' => 'PaymentController@index']);
	Route::put('payments/create/{sched}', 'PaymentController@store');

	Route::get('/ajaxCalculate', 'LoanController@calculate');

	Route::get('/calculator', ['as' => 'loans.calculator', 'uses' => 'LoanController@calculator']);
	
});

