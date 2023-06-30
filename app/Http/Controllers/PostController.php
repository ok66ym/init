<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;
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
        
        //クライアントインスタンス生成
        $client = new \GuzzleHttp\Client();
        
        //GET通信するURL
        $url = 'https://teratail.com/api/v1/questions';
        
        //リクエスト送信と返却データの取得
        //Bearerトークンにアクセストークンを指定して認証を行う．
        $response = $client->request(
            'GET', 
            $url,
            ['Bearer' => config('services.teratail.token')]
        );
        
        //API通信で取得したデータはjson形式なので
        //PHPファイルに対応した連想配列にデコード
        $questions = json_decode($response->getBody(), true);
        
        //index bladeに取得データを渡す
        return view('posts.index')->with([
            'posts' => $post->getPaginateByLimit(),
            'questions' => $questions['questions'],
        ]);
        //view~->with~：withメソッドでの値を返り値をしている．
        //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
        // return $post->get();//Postモデルのgetメソッドの実行結果として$postの中身を戻り値にする．
    }
    
    public function show(Post $post) {
        return view('posts.show')->with(['post' => $post]);
        //'post'は，baldeファイルで使用する変数．中身は$postはid=1のPostインスタンス．
    }
    
    public function create(Category $category) {
        return view('posts.create')->with(['categories' => $category->get()]);
        //postsの中のcreate.blade.phpを返却する
    }
    
    public function store(Post $post, PostRequest $request) {
        $input = $request['post']; 
        $input += ['user_id' => $request->user()->id];    //relation: Post and User
        $post -> fill($input) -> save();
        return redirect('/posts/' . $post -> id);
    }
    
    public function edit(Post $post) {
        return view('posts.edit') -> with(['post' => $post]);
    }
    
    public function update(Post $post, PostRequest $request) {
        $input_post = $request['post'];
        $input_post += ['user_id' => $request->user()->id];    //relation: Post and User
        $post -> fill($input_post) -> save();
        return redirect('/posts/' . $post -> id);
    }
    
    public function delete(Post $post) {
        $post -> delete();
        return redirect('/');
    }
}
