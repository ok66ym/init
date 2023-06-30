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
        <h1 class=title>
            タイトル：{{$post -> title}}
        </h1>
        
        <div class='content'>
                <div class='content_post'>
                    <h3>本文</h3>
                    <p class='body'>
                        {{$post->body}}
                    </p>
                </div>
        </div>
        
        <a href="/categories/{{$post->category->id}}">カテゴリー：{{$post -> category -> name}}<br></a>
        
        <!--Postインスタンスのプロパティとして投稿者の名前情報を参照-->
                    <small>投稿者：{{ $post->user->name }}<br><br></small>
                    
        <div class="edit">
            <a href="/posts/{{$post -> id}}/edit">編集する</a>
        </div>
        
        <div class='footer'>
            <a href="/">戻る</a>
        </div>
    </body>
</x-app-layout>
</html>