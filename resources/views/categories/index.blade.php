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
            <h1 class="text-4xl font-bold mb-4">音楽ファイル共有アプリ</h1>
            <div class="text-center mb-4">
                <a href="/posts/create" class="text-blue-500 hover:underline">create</a>
            </div>
            <div class="posts space-y-8">
                @foreach($posts as $post)
                    <div class="post bg-white p-6 rounded-lg shadow-lg">
                        <a href="/posts/{{ $post->id }}">
                            <h2 class="text-2xl font-semibold mb-2">{{ $post->title }}</h2>
                        </a>
                        <h5 class="category text-gray-500 mb-2">
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
                        <div class="flex justify-between items-center">
                            <a href="{{ $post->audio_url2 }}" class="text-blue-500 hover:underline">再生URL</a>
                            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deletePost({{ $post->id }})" class="text-red-500 hover:underline">delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="paginate mt-8">
                {{ $posts->links() }}
            </div>
        </div>
        <script>
            function deletePost(id) {
                'use strict';
                if(confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        <div class="text-center mt-8">
            ログインユーザー: {{ Auth::user()->name }}
        </div>
    </x-app-layout>
</body>
</html>
