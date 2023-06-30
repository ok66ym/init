<!DOCTYPE html>
<!--<html lang="ja">-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<x-app-layout>
    <body>
        <div>
            @foreach($questions as $question)
                <div>
                    <a href="https://teratail.com/questions/{{ $question['id'] }}">
                        {{ $question['title'] }}
                    </a>
                </div>
            @endforeach
        </div>
        <a href="/posts/create">[create]</a>
        <h1><b>ブログ一覧</b></h1>
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'>
                        <a href="/posts/{{$post -> id}}">タイトル：{{$post -> title}}</a>
                    </h2>
                    
                    <p class='body'>本文<br>{{$post->body}}</p>
                    
                    <a href="/categories/{{$post->category->id}}">カテゴリー：{{$post -> category -> name}}<br></a>
                    
                    <!--Postインスタンスのプロパティとして投稿者の名前情報を参照-->
                    <small>投稿者：{{ $post->user->name }}<br></small>
                    
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deletePost({{ $post->id }})">投稿を削除する</button> 
                    </form>
    
                </div>
            @endforeach
        </div>
            <div class='paginate'>
                {{$posts->links() }}<br>
            </div>
        
        <p>ログインユーザー：{{ Auth::user()->name }}</p>
        
        <script>
            function deletePost(id) {
                'use strict'
                if (confirm('削除すると復元できません．\n本当に削除しますか?')) {
                    document.getElementById(`form_${id}`).submit(); 
                    //'form_${id}'は``<バッククオートで囲む>→文字列の中で変数を扱うことができる．
                    //getElementByIdの引数は，<form>タグでの呼び出し時にidを引数として与える．
                }
            }
        </script>
    </body>
</x-app-layout>
</html>