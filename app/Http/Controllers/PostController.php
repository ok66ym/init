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
        // $test = $post->orderBy('updated_at', 'DESC')->limit(2)->toSql();   //確認用に追加
        // dd($test);  //確認用に追加
        
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);
        //view~->with~：withメソッドでの値を返り値をしている．
        //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
        // return $post->get();//Postモデルのgetメソッドの実行結果として$postの中身を戻り値にする．
    }
    
    public function show(Post $post) {
        return view('posts.show')->with(['post' => $post]);
        //'post'は，baldeファイルで使用する変数．中身は$postはid=1のPostインスタンス．
    }
    
    public function create() {
        return view('posts.create');
        //postsの中のcreate.blade.phpを返却する
    }
    
    public function store(Request $request, Post $post) {
        $input = $request['post'];
        $post -> fill($input) -> save();
        return redirect('/posts/' . $post -> id);
    }
}
