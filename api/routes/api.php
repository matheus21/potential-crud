<?php


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

Route::middleware(
    [
        'api'
    ]
)->prefix('developers')
    ->namespace($this->namespace)
    ->group(function () {
       Route::get('/', 'DevelopersController@getDevelopers');
       Route::get('/{id}', 'DevelopersController@getDeveloper');
       Route::post('/', 'DevelopersController@postDeveloper');
       Route::put('/{id}', 'DevelopersController@putDeveloper');
       Route::delete('/{id}', 'DevelopersController@deleteDeveloper');
    });
