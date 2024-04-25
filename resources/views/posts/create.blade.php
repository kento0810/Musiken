<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>音楽ファイル共有アプリ</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body class="antialiased">
        <h1>音楽ファイル共有アプリ</h1>
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>Song Title</h2>
                <input type="text" name=post[title] placeholder="タイトル">
            </div>
            <div class="body">
                <h2>歌詞</h2>
                <textarea name="post[body1]" placeholder="歌詞"></textarea>
            </div>
             <div class="body">
                <h2>説明</h2>
                <textarea name="post[body2]" placeholder="テーマ、工夫したこと、こだわりなど"></textarea>
            </div>
            <div class="audio">
                <input type="file" name="audio">
            </div>
            <input type="submit" value="store">
        </form>
        <div class='footer'>
            <a href="/">戻る</a>
        </div>
    </body>
</html>
