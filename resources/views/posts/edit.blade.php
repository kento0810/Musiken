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
        <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="title">
                <h2>Song Title</h2>
                <input type="text" name=post[title] placeholder="タイトル" value={{ $post->title }}>
                <p class='title__error' style="color:red">{{ $errors->first('post.title')}} </p>
            </div>
            <div class="body">
                <h2>歌詞</h2>
                <textarea name="post[body1]" placeholder="歌詞">{{ $post->body1 }}</textarea>
                <p class='body__error' style="color:red">{{ $errors->first('post.body1')}} </p>
            </div>
             <div class="body">
                <h2>説明</h2>
                <textarea name="post[body2]" placeholder="テーマ、工夫したこと、こだわりなど">{{ $post->body2 }}</textarea>
                <p class='body__error' style="color:red">{{ $errors->first('post.body2')}} </p>
            </div>
            <div class="audio">
                <input type="file" name="audio" value={{ $post->audio_url }}>
                <p class='audio__error' style="color:red">{{ $errors->first('audio')}} </p>
            </div>
            <div class="audio">
                <input type="url" name="post[audio_url2]" value={{ $post->audio_url2 }}>
                <p class='audio__error' style="color:red">{{ $errors->first('post.audio_url2')}} </p>
            </div>
            <input type="submit" value="update">
        </form>
        <div class='footer'>
            <a href="/posts/{{ $post->id }}">戻る</a>
        </div>
    </body>
</html>
