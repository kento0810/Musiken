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
        <a href="/posts/create">create</a>
        <div class='posts'>
            @foreach($posts as $post)
                <div class='post'>
                    <a href="/posts/{{ $post->id }}"><h2 class='title'>{{ $post->title }}</h2></a>
                </div>
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
                <div>
                    <a href="{{ $post->audio_url2 }}">再生URL</a>
                </div>
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">delete</button>
                    </form>
            @endforeach
        </div>
        <div class='paginate'>{{ $posts->links()}}</div>
        <script>
            function deletePost(id) {
                'use strict'
                
                if(confirm('削除すると復元できません。\n本当に削除しますか?')) {
                    document.getElementById(`form_${id}`).submit();    
                }
            }
        </script>
    </body>
</html>
