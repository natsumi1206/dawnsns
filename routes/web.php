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

// Route::get('/', function () {
//     return view('welcome');
// });
//↑コメントアウトされていた
// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();





//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::get('/register', 'Auth\RegisterController@registerForm');
Route::post('/register', 'Auth\RegisterController@store');

Route::get('/added', 'Auth\RegisterController@added');
Route::get('/added', 'Auth\RegisterController@addedUser');

Route::get('/logout', 'Auth\LoginController@logout');


//ログイン中のページ

//トップページ

Route::get('/top','PostsController@top');
Route::get('/top', 'PostsController@show');




//ツイート投稿
Route::post('top', 'PostsController@create');
//ツイート削除
Route::get('post/{id}/delete', 'PostsController@delete');
//ツイート編集
Route::put('/top', 'PostsController@update')->name('updatePost');





//自分のプロフィール画面
Route::group(['prefix' => '/{id}'], function(){
Route::get('/profile', 'UsersController@profileIndex');
Route::post('/profile', 'PostsController@uppost')->name('upPost');
});

//編集
Route::get('/profileEdit', 'UsersController@edit');
  Route::post('/profileEdit', 'UsersController@update')->name('updateProfile');

//パスワード変更
Route::get('/password','UsersController@showChangePasswordForm');
  //パスワードを変更の処理（POST)の場合はchangePasswordメソッドを実行ルーティング名はchangePassword
  Route::post('/password', 'UsersController@changePassword')->name('changePassword');


//ユーザー検索ページ
Route::get('/search','UsersController@index');



//フォローリスト・フォロワーリスト
  Route::get('followList', 'UsersController@followings')->name('followings');
  Route::get('followerList', 'UsersController@followers')->name('followers');

  //フォロー/フォロー解除
    Route::group(['prefix' => 'users/{id}'], function(){
      Route::post('/search', 'FollowsController@store')->name('follow');
      Route::delete('/search', 'FollowsController@destroy')->name('unfollow');
    });
