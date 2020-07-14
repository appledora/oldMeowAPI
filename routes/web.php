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

/* Rename files */
Route::get('rename', 'RenameController@index')->name('renameFiles');
Route::post('rename', 'RenameController@moveFiles')->name('moveFiles');
Route::post('renameFile', 'RenameController@moveFile')->name('moveFile');
Route::post('delete', 'RenameController@delete')->name('deleteFile');

/* Edit Tags */
Route::get('editTags', 'EditTagController@index')->name('editTags');
Route::post('tag', 'EditTagController@tagFiles')->name('tagFiles');
Route::post('tagFile', 'EditTagController@tagFile')->name('tagFile');

Route::get('upload', 'SongController@showForm') -> name('songUpload');
Route::post('upload','SongController@store') ->name('songUpload');
Route::post('song/upload', 'SongController@upload')->name('upload');