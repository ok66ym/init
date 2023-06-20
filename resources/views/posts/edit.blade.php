<!DOCTYPE html>
<!--<html lang="ja">-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <h1>編集画面</h1>
    <div class="content">
        <form action="/posts/{{$post -> id}}" method="POST">
            @csrf
            @method('PUT')
            <dov class="content_title">
                <h2>Title</h2>
                <input type="text" name="post[title]" value="{{$post -> title}}"/>
            </dov>
            <div class="content_body">
                <input type="text" name="post[body]" value="{{$post -> body}}"/>
            </div>
            <input type="submit" value="store"/>
        </form>
    </div>
</body>
</html>