<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/user/signup', 'AuthController@registerUser')->name('user.signup');
Route::post('/user/login', 'AuthController@loginUser')->name('user.login');

Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::group(['prefix'=>'category','as'=>'category'], function(){
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::post('/add', 'CategoryController@add')->name('category.add');
        Route::put('/update/{id}', 'CategoryController@update')->name('category.update');
        Route::delete('/delete/{id}', 'CategoryController@delete')->name('category.delete');
    });

});
