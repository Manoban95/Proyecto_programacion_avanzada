<?php

use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('welcome');
});




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

 Route::group(['middleware' => ['auth']], function(){

Route::get('/books','BookController@index');
Route::POST('/books','BookController@store');

Route::get('/Loan', 'LoanController@index');
Route::put('/Loan','LoanController@update');

Route::get('/categories','CategoryController@index');
Route::post('/categories','CategoryController@store');
Route::put('/categories', 'CategoryController@update');
Route::delete('/categories/{category}','CategoryController@destroy');

Route::get('/user', 'UserController@index');
Route::post('/user','UserController@store');
Route::delete('/user/{user}','UserController@destroy');
Route::put('/user', 'UserController@update');








    
 });

