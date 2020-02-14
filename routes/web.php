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
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function() {
        return redirect('members');
    });
    Route::resource('/members', 'MemberController');
    Route::post('/members/{id}/verify', 'MemberController@updateVerification')->name('members.updateVerification');
    Route::post('/members/upload-image', 'MemberController@uploadImage')->name('members.upload-image');
});
Route::get('/members/{id}/credential', 'MemberController@printPdfCredential')->name('members.printPdfCredential');
Route::get('/members/create', 'MemberController@create')->name('members.create');
Route::get('/test', function() {
    return view('members.credential', ['member' => \App\Member::first()]);
});
Auth::routes(['register' => false]);
