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
        <h1 class='title'>
            {{ $post->title }}
        </h1>
        <div class='content'>
            <div class='content_post'>
                ジャンル:
                <h5 class='category'>
                @foreach($post->categories as $category)   
                    <a href="/categories/{{ $category->id }}">{{ $category->name }}</a>
                @endforeach
                </h5>
                <audio controls src="{{ $post->audio_url }}">再生</audio>
                <p><a href="{{ $post->audio_url2 }}">再生URL</a></p>
                <h3>歌詞</h3>
                <p class='body'>{{ $post->body1 }}</p>
                <h3>説明</h3>
                <p class='body'>{{ $post->body2 }}</p>
            </div>
            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deletePost({{ $post->id }})">delete</button>
            </form>
        </div>
        <div class='edit'>
            <a href="/posts/{{ $post->id }}/edit">編集</a>
        </div>
        <div class='footer'>
            <a href="/">戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>
