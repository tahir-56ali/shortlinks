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

use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    $users = DB::table('users')->paginate(2);
    return view('home', ['users' => $users]);
});

Route::get('edit-user', function () {
   return \Illuminate\Http\Request::get;
});

Route::resource('products','ProductController');
