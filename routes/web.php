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
    return view('login');
});


Route::get('/login', function () {
    return view('login');
});

Route::post('post-login', array('as'=>'masuk','uses'=>'AdminController@masuk'));
Route::get('logout', 'AdminController@logout');


Route::group(['middleware' => 'web'], function () {	

Route::get('/admin/index', 'AdminController@dash');

Route::resource('user','UserController');
Route::resource('kampung','KampungController');
Route::resource('kegiatan','KegiatanController');
Route::resource('komentar','KomentarController');

Route::post('komentar-tampil/{id}', array('as' => 'nampil','uses' => 'KomentarController@tampil'));
Route::post('komentar-hilangkan/{id}', array('as'=>'ilang','uses'=>'KomentarController@hilangkan'));

Route::post('kegiatan-tampil/{id}', array('as' => 'tampil','uses' => 'KegiatanController@tampil'));
Route::post('kegiatan-hilangkan/{id}', array('as'=>'hilangkan','uses'=>'KegiatanController@hilangkan'));

});
