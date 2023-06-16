<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
//use宣言は外部にあるクラスをPostController内にインポートできる。
//この場合、App\Models内のPostクラスをインポートしている。
//PostController.php内でPost.phpのPostクラスを使用したいため
/**
 * Post一覧を表示する
 * 
 * @param Post Postモデル
 * @return array Postモデルリスト
 */;

class PostController extends Controller
{
    public function index(Post $post) //インポートしたPostをインスタンス化して$postとして使用
    {
        return view('posts.index')->with(['posts' => $post->get()]);
        //view~->with~：withメソッドでの値を返り値をしている．
        //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
        // return $post->get();//Postモデルのgetメソッドの実行結果として$postの中身を戻り値にする．
    }
}
