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

// routes for URL shorten
Route::get('generate-shorten-link', 'ShortLinkController@index')->name('short-links');
Route::post('generate-shorten-link', 'ShortLinkController@store')->name('generate.shorten.link.post');

// most visited links
Route::get('popular-links', 'ShortLinkController@popularLinks')->name('popular-links');

// visit url and increment visit count
Route::get('{code}', 'ShortLinkController@shortenLink')->name('shorten.link');

