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
Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('admin.login');
Route::group([
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers\Auth'
], function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'LoginController@login');
    Route::get('/logout', 'LoginController@logout')->name('admin.logout');
});

Route::group([
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers\Admin',
    'middleware' => ['admin']
], function () {
    //Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
    //profile
    Route::get('/user/profile','UserController@edit')->name('admin.profile');
    Route::post('/user/profile','UserController@update')->name('admin.profile');
    //service
    Route::get('/service','ServiceController@index')->name('admin.service');
    Route::get('/service/add','ServiceController@create')->name('admin.create');
    Route::post('/service/add','ServiceController@store')->name('admin.store');
    Route::get('/service/remove/{id}','ServiceController@delete')->name('admin.service.remove');
    Route::get('/service/edit/{id}','ServiceController@edit')->name('admin.service.edit');
    Route::post('/service/edit/{id}','ServiceController@update')->name('admin.service.update');
    //receipts
    Route::get('/receipts','ReceiptsController@index')->name('admin.receipts');
    //ajax receipts
    Route::post('/ajax_date','ReceiptsController@date');
    Route::get('/ajax_everyday','ReceiptsController@everyday');
    Route::get('/ajax_month','ReceiptsController@topmonth');
    Route::get('/ajax_day','ReceiptsController@topday');
    Route::get('/ajax_year','ReceiptsController@topyear');

});
