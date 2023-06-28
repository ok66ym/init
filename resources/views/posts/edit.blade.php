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
        <h1>編集画面</h1>
        <div class="content">
            <form action="/posts/{{$post -> id}}" method="POST">
                @csrf
                @method('PUT')
                <dov class="content_title">
                    <h2>Title</h2>
                    <input type="text" name="post[title]" value="{{$post -> title}}"/>
                    <p class="title_error" style="color:red">{{$errors -> first('post.title')}}</p>
                </dov>
                <div class="content_body">
                    <input type="text" name="post[body]" value="{{$post -> body}}"/>
                    <p class="body_error" style="color:red">{{$errors -> first('post.body')}}</p>
                </div>
                <input type="submit" value="store"/>
            </form>
        </div>
    </body>
</x-app-layout>
</html>