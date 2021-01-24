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

Route::get('/', 'CsvController@index')->name('/');
Route::post('/uploadCsv', 'CsvController@uploadCsv')->name('uploadCsv');
Route::get('/fechasId', 'CsvController@fechasId')->name('fechasId');
Route::get('/duplicados', 'CsvController@duplicados')->name('duplicados');
Route::get('/erroneos', 'CsvController@erroneos')->name('erroneos');