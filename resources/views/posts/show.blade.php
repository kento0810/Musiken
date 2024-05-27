<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>音楽ファイル共有アプリ</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="antialiased bg-gray-100 text-gray-900">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                音楽ファイル共有アプリ
            </h2>
        </x-slot>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>
            <div class="content bg-white p-6 rounded-lg shadow-lg">
                <h5 class="category text-gray-500 mb-4">
                    ジャンル:
                    @foreach($post->categories as $category)
                        <a href="/categories/{{ $category->id }}" class="text-blue-500 hover:underline">{{ $category->name }}</a>
                    @endforeach
                </h5>
                @if($post->audio_url)
                    <div class="mb-4">
                        <audio controls src="{{ $post->audio_url }}" class="w-full"></audio>
                    </div>
                @endif
                <div class="mb-4">
                    <a href="{{ $post->audio_url2 }}" class="text-blue-500 hover:underline">再生URL</a>
                </div>
                <h3 class="text-xl font-semibold mb-2">歌詞</h3>
                <p class="body text-gray-700 mb-4">{{ $post->body1 }}</p>
                <h3 class="text-xl font-semibold mb-2">説明</h3>
                <p class="body text-gray-700 mb-4">{{ $post->body2 }}</p>
                @auth
                    <div class="flex items-center mb-4">
                        @if ($post->isLikedBy(Auth::user()))
                            <span class="likes flex items-center">
                                <i class="fas fa-heart heart like-toggle text-red-500 cursor-pointer" data-post-id="{{ $post->id }}"></i>
                                <span class="like-counter ml-2">{{ $post->likes_count }}</span>
                            </span>
                        @else
                            <span class="likes flex items-center">
                                <i class="fas fa-heart heart like-toggle text-gray-500 cursor-pointer" data-post-id="{{ $post->id }}"></i>
                                <span class="like-counter ml-2">{{ $post->likes_count }}</span>
                            </span>
                        @endif
                    </div>
                @endauth
                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" class="mb-4">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $post->id }})" class="text-red-500 hover:underline">delete</button>
                </form>
                <form action="/comments" method="POST" class="mb-4">
                    @csrf
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold mb-2">コメント追加</h2>
                        <textarea name="comment[body]" class="w-full p-2 border rounded" placeholder="感想、改善点など">{{ old('comment.body') }}</textarea>
                        @if ($errors->has('comment.body'))
                            <p class="text-red-500">{{ $errors->first('comment.body') }}</p>
                        @endif
                        <input type="hidden" name="comment[post_id]" value="{{ $post->id }}">
                    </div>
                    <input type="submit" value="store" class="bg-blue-500 text-white p-2 rounded cursor-pointer">
                </form>
                @foreach($post->comments as $comment)
                    <div class="comment bg-gray-100 p-4 rounded-lg mb-4">
                        <p class="user font-semibold">{{ $comment->user->name }}</p>
                        <p class="body text-gray-700">{{ $comment->body }}</p>
                        <form action="/comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deleteComment({{ $comment->id }})" class="text-red-500 hover:underline">delete</button>
                        </form>
                    </div>
                @endforeach
                <div class="edit mb-4">
                    <a href="/posts/{{ $post->id }}/edit" class="text-blue-500 hover:underline">編集</a>
                </div>
                <div class="footer">
                    <a href="/" class="text-blue-500 hover:underline">戻る</a>
                </div>
            </div>
        </div>
    </x-app-layout>
    <script>
        function deletePost(id) {
            'use strict';
            if(confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
        function deleteComment(id) {
            'use strict';
            if(confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>
</html>
