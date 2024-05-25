<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>音楽ファイル共有アプリ</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <x-app-layout>
        <x-slot name="header">
            音楽ファイル共有アプリ
        </x-slot>
    <body class="antialiased">
        <h1>音楽ファイル共有アプリ</h1>
        <form action="/posts/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>Song Title</h2>
                <input type="text" name=post[title] placeholder="タイトル" value={{ old('post.title' )}}>
                <p class='title__error' style="color:red">{{ $errors->first('post.title')}} </p>
            </div>
            <div class="category">
                <h2>ジャンル</h2>
                @foreach($categories as $category)
                    <label>
                        <input type='checkbox' value="{{ $category->id }}" name="categories_array[]">
                            {{$category->name}}
                        </input>
                    </label>
                @endforeach
            </div>
            <div class="body">
                <h2>歌詞</h2>
                <textarea name="post[body1]" placeholder="歌詞">{{ old('post.body1' )}}</textarea>
                <p class='body__error' style="color:red">{{ $errors->first('post.body1')}} </p>
            </div>
             <div class="body">
                <h2>説明</h2>
                <textarea name="post[body2]" placeholder="テーマ、工夫したこと、こだわりなど">{{ old('post.body2' )}}</textarea>
                <p class='body__error' style="color:red">{{ $errors->first('post.body2')}} </p>
            </div>
            <div class="audio">
                <input type="file" name="audio">
                <p class='audio__error' style="color:red">{{ $errors->first('audio')}} </p>
            </div>
            <div class="audio">
                <input type="url" name="post[audio_url2]" placeholder="再生URL">
                <p class='audio__error' style="color:red">{{ $errors->first('post.audio_url2')}} </p>
            </div>
            <input type="submit" value="store">
        </form>
        <div class='footer'>
            <a href="/">戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>
