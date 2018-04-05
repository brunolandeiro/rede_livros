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

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('perfil/{perfil_id}', 'HomeController@index')->name('perfil');
Route::post('UpdatePerfil', 'HomeController@UpdatePerfil')->name('UpdatePerfil');
Route::post('AddLivro', 'HomeController@AddLivro')->name('AddLivro');
Route::post('trocaEstante', 'HomeController@trocaEstante')->name('trocaEstante');
//livro Controller
Route::get('livro/{livro_id}/{usuario_id}', 'LivroController@index')->name('livro');


Route::get('/', 'HomeController@index');
