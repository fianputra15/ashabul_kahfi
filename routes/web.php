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
Route::get('/login','LoginController@index')->name('login');
Route::get('/','UserController@index')->name('home');
Route::get('pendaftaran','UserController@pendaftaran')->name('pendaftaran');
//For Dummy Data
Route::get('dummy','LoginController@register_dummy')->name('register_dummy');
Route::get('dummy_materi','UserController@dummyMateri')->name('dummy_materi');
//Verify
Route::post('/verify','LoginController@verify')->name('verify');


Route::middleware('admin_check')->group(function (){
    //Admin
    Route::get('admin','AdminController@index')->name('admin');
//Profile
    Route::get('admin/profile','AdminController@profile')->name('admin_profile');
    Route::get('admin/profile/edit','AdminController@edit_profile')->name('edit_profile');
    Route::post('admin/profile/update_profile','AdminController@update_profile')->name('update_profile');

//Proker
    Route::get('admin/proker','AdminController@proker')->name('admin_proker');
    Route::get('admin/edit_proker','AdminController@edit_proker')->name('edit_proker');
    Route::post('admin/update_proker','AdminController@update_proker')->name('update_proker');

//Materi
    Route::get('admin/materi','AdminController@materi')->name('admin_materi');
    Route::get('admin/edit_materi/{id}','AdminController@edit_materi')->name('edit_materi');
    Route::get('admin/tambah_materi','AdminController@tambah_materi')->name('tambah_materi');
    Route::post('admin/store_materi','AdminController@store_materi')->name('store_materi');
    Route::post('admin/update_materi/{id}','AdminController@update_materi')->name('update_materi');
    Route::get('admin/delete_materi/{id}','AdminController@delete_materi')->name('delete_materi');

//Materi
    Route::get('admin/berita','AdminController@berita')->name('admin_berita');
    Route::get('admin/edit_berita/{id}','AdminController@edit_berita')->name('edit_berita');
    Route::get('admin/tambah_berita','AdminController@tambah_berita')->name('tambah_berita');
    Route::post('admin/store_berita','AdminController@store_berita')->name('store_berita');
    Route::post('admin/update_berita/{id}','AdminController@update_berita')->name('update_berita');
    Route::get('admin/delete_berita/{id}','AdminController@delete_berita')->name('delete_berita');

//Pendaftaran
    Route::post('store_pendaftaran','AnggotaController@store_anggotabaru')->name('daftar_anggotabaru');
    Route::get('admin/calon_anggota','AnggotaController@calon_anggota')->name('calon_anggota');
    Route::get('admin/delete_calon/{id}','AnggotaController@delete_calon')->name('delete_calon');
//Anggota
    Route::get('admin/anggota','AdminController@anggota')->name('admin_anggota');
    Route::get('admin/delete_anggota/{id}','AdminController@delete_anggota')->name('delete_anggota');
    Route::get('admin/tambah_anggota','AdminController@tambah_anggota')->name('tambah_anggota');
    Route::post('admin/store_anggota','AdminController@store_anggota')->name('store_anggota');
    Route::get('admin/edit_anggota/{id}','AdminController@edit_anggota')->name('edit_anggota');
    Route::post('admin/update_anggota/{id}','AdminController@update_anggota')->name('update_anggota');
});

//User
Route::get('berita','UserController@berita')->name('berita');
Route::get('materi','UserController@materi')->name('materi');
Route::get('proker','UserController@proker')->name('proker');
Route::get('get_materi/{id}','UserController@get_materi')->name('get_materi');
Route::get('detail_materi/{id}','UserController@detail_materi')->name('detail_materi');
Route::get('profile','UserController@profile')->name('profile');
Route::get('/user/profile_user/{id}','UserController@profile_user')->name('profile_user');
Route::get('/berita/detail_berita/{id}','UserController@detail_berita')->name('detail_berita');
Route::post('update_profile_user','UserController@update_profile')->name('update_profile_user');


//Testing
Route::get('berita_redis','PengujianController@berita_withredis')->name('berita_redis');
Route::get('berita_sql','PengujianController@berita')->name('berita_sql');

//Logout
Route::get('/logout','LoginController@logout')->name('logout');

