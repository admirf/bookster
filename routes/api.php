<?php

use Illuminate\Http\Request;

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

Route::namespace('Api')->group(function () {

    Route::post('/sign-up', 'AuthController@signUp');
    Route::post('/login', ['uses' => 'AuthController@login', 'as' => 'login']);
    Route::get('/logout', 'AuthController@logout')->middleware(['auth:api']);
    Route::get('/refresh', 'AuthController@refresh')->middleware(['auth:api']);
    Route::get('/me', 'AuthController@me')->middleware(['auth:api']);
    Route::get('/balance', 'UserController@balance')->middleware(['auth:api']);
    Route::post('/add-balance', 'UserController@addBalance')->middleware(['auth:api']);
    Route::post('/buy', 'BuyController')->middleware(['auth:api']);

    Route::get('/users', 'UserController@index');
    Route::get('/users/{user}', 'UserController@show');
    Route::get('/users/{user}/books', 'UserBookController');
    Route::delete('/users/{user}', 'UserController@destroy')->middleware(['auth:api', 'role:admin']);
    Route::get('/me/books', 'UserBookController@books')->middleware(['auth:api']);

    Route::get('/categories', 'CategoryController@index');
    Route::get('/categories/{category}', 'CategoryController@show');
    Route::post('/categories', 'CategoryController@store')->middleware(['auth:api', 'permission:create categories']);
    Route::put('/categories/{category}', 'CategoryController@update')->middleware(['auth:api', 'permission:edit categories']);
    Route::delete('/categories/{category}', 'CategoryController@destroy')->middleware(['auth:api', 'permission:delete categories']);

    Route::get('/reports', 'ReportController@index')->middleware(['auth:api', 'permission:view reports']);
    Route::get('/reports/{report}', 'ReportController@show')->middleware(['auth:api', 'permission:view reports']);
    Route::post('/reports', 'ReportController@store')->middleware(['auth:api', 'permission:create reports']);
    Route::delete('/reports/{report}', 'ReportController@destroy')->middleware(['auth:api', 'permission:delete reports']);

    Route::get('/books', 'BookController@index');
    Route::get('/search', 'BookSearchController');
    Route::get('/books/{book}', 'BookController@show');
    Route::post('/books', 'BookController@store')->middleware(['auth:api', 'permission:create books']);
    Route::put('/books/{book}', 'BookController@update')->middleware(['auth:api', 'permission:edit books']);
    Route::delete('/books/{book}', 'BookController@destroy')->middleware(['auth:api', 'permission:delete books']);
    Route::get('/books/{book}/media', 'BookMediaController@index');
    Route::post('/books/{book}/media', 'BookMediaController@upload')->middleware(['auth:api', 'permission:edit books']);

    Route::get('/transactions', 'TransactionController@index')->middleware(['auth:api', 'permission:view transactions']);
    Route::get('/transactions/{transaction}', 'TransactionController@show')->middleware(['auth:api', 'permission:view transactions']);
    Route::get('/transactions/{transaction}/complete', 'TransactionController@complete')->middleware(['auth:api', 'permission:complete transactions']);
});