<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;    //外部にあるPostControllerクラスをインポート

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
Route::get('/', [PostController::class, 'index']);

Route::get('/posts/create', [PostController::class, 'create']);
//showメソッドの呼び出しよりも先に記述する必要がある

Route::get('/posts/{post}', [PostController::class, 'show']);
// '/posts/{対象データのID}'にGetリクエストが来たら、PostControllerのshowメソッドを実行する

Route::post('/posts', [PostController::class, 'store']);

Route::get('/posts/{post}/edit', [PostController::class, 'edit']);
//ブログ投稿編集画面の表示

Route::put('/posts/{post}', [PostController::class, 'update']);
//ブログ投稿編集実行

Route::delete('/posts/{post}', [PostController::class, 'delete']);
//ブログ投稿削除


// Route::get('/', function() {
//     return view('posts.index');
// });

// Route::get('/', function () {
//     return view('welcome');
// });