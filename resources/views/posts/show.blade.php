<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" >
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
                @if($post->audio_url)
                <div>
                    <audio controls src="{{ $post->audio_url }}">再生</audio>
                </div>
                @endif
                <p><a href="{{ $post->audio_url2 }}">再生URL</a></p>
                <h3>歌詞</h3>
                <p class='body'>{{ $post->body1 }}</p>
                <h3>説明</h3>
                <p class='body'>{{ $post->body2 }}</p>
            </div>
            
            @auth
            <!-- Post.phpに作ったisLikedByメソッドをここで使用 -->
            @if (!$post->isLikedBy(Auth::user()))
                <span class="likes">
                    <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
                <span class="like-counter">{{$post->likes_count}}</span>
                </span><!-- /.likes -->
            @else
                <span class="likes">
                    <i class="fas fa-heart heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
                <span class="like-counter">{{$post->likes_count}}</span>
                </span><!-- /.likes -->
            @endif
            @endauth
            

            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deletePost({{ $post->id }})">delete</button>
            </form>
        </div>
            <form action="/comments" method="POST">
                @csrf
                <div class="body">
                    <h2>コメント追加</h2>
                    <textarea name="comment[body]" placeholder="感想、改善点など">{{ old('comment.body' )}}</textarea>
                    <p class='body__error' style="color:red">{{ $errors->first('comment.body')}} </p>
                    <input type="hidden" name="comment[post_id]" value="{{ $post->id }}">
                </div>
                <input type="submit" value="store">
            </form>
        @foreach($post->comments as $comment)
            <div class='comment'>
                <p class='user'>{{ $comment->user->name }}</p>
                <p class='body'>{{ $comment->body }}</p>
                <form action="/comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $comment->id }})">delete</button>
                </form>
            </div>
        @endforeach 
        <div class='edit'>
            <a href="/posts/{{ $post->id }}/edit">編集</a>
        </div>
        <div class='footer'>
            <a href="/">戻る</a>
        </div>
        <script>
            function deletePost(id) {
                'use strict'
                
                if(confirm('削除すると復元できません。\n本当に削除しますか?')) {
                    document.getElementById(`form_${id}`).submit();    
                }
            }
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        
    </body>
    </x-app-layout>
</html>
