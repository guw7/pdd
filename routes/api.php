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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

//================================= USER_MANAGEMENT =========================================

//	 $api->get('get-all-user/{id}', 'App\Http\Controllers\UserAPIController@get_alluserid');
	 $api->post('user-login', 'App\Http\Controllers\UserAPIController@login');
	 $api->post('user-register', 'App\Http\Controllers\UserAPIController@register');
	 $api->post('user-editpassword/{id}', 'App\Http\Controllers\UserAPIController@editpassword');
	 $api->post('user-editprofile/{id}', 'App\Http\Controllers\UserAPIController@editprofile');

//=================================== APLICATION =============================================

	 $api->get('get-all-kampung', 'App\Http\Controllers\KampungAPIController@get_allkampung');
//	 $api->get('get-all-kampung/{id}' 'App\Http\Controllers\KampungAPIController@get_allkampung');

	 $api->get('get-all-kegiatan', 'App\Http\Controllers\KegiatanAPIController@get_allkegiatan');
	 $api->get('get-all-kegiatan/{id}', 'App\Http\Controllers\KegiatanAPIController@get_allkegiatanid');
//	 $api->post('kegiatan-kegiatan', 'App\Http\Controllers\KegiatanAPIController@post_kegiatan');

//===================================== COMMENT ============================================

	 $api->get('get-comment/{id}', 'App\Http\Controllers\KomentarAPIController@get_komentar'); 
	 $api->get('get-commentuser/{id}', 'App\Http\Controllers\KomentarAPIController@get_komentaruser'); 
	 $api->post('user-comment/{id}', 'App\Http\Controllers\KomentarAPIController@post_komentar');

//================================== LIKE & DISLIKE ========================================

	 $api->post('kegiatan-like/{id}', 'App\Http\Controllers\KegiatanAPIController@post_like');
	 $api->post('kegiatan-dislike/{id}', 'App\Http\Controllers\KegiatanAPIController@post_dislike');

//====================================== SEARCH ========================================

	 $api->get('pencarian/{name}', 'App\Http\Controllers\KegiatanAPIController@cari');

});

 	//Route::get('pencarian/{name}','KegiatanAPIController@cari');
