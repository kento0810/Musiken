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
            <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <h2 class="text-xl font-semibold mb-2">Song Title</h2>
                    <input type="text" name="post[title]" placeholder="タイトル" value="{{ $post->title }}" class="w-full p-2 border rounded">
                    @if ($errors->has('post.title'))
                        <p class="text-red-500">{{ $errors->first('post.title') }}</p>
                    @endif
                </div>
                <div class="mb-4">
                    <h2 class="text-xl font-semibold mb-2">歌詞</h2>
                    <textarea name="post[body1]" placeholder="歌詞" class="w-full p-2 border rounded">{{ $post->body1 }}</textarea>
                    @if ($errors->has('post.body1'))
                        <p class="text-red-500">{{ $errors->first('post.body1') }}</p>
                    @endif
                </div>
                <div class="mb-4">
                    <h2 class="text-xl font-semibold mb-2">説明</h2>
                    <textarea name="post[body2]" placeholder="テーマ、工夫したこと、こだわりなど" class="w-full p-2 border rounded">{{ $post->body2 }}</textarea>
                    @if ($errors->has('post.body2'))
                        <p class="text-red-500">{{ $errors->first('post.body2') }}</p>
                    @endif
                </div>
                <div class="mb-4">
                    <h2 class="text-xl font-semibold mb-2">Audio File</h2>
                    <input type="file" name="audio" value="{{ $post->audio_url }}" class="w-full p-2 border rounded">
                    @if ($errors->has('audio'))
                        <p class="text-red-500">{{ $errors->first('audio') }}</p>
                    @endif
                </div>
                <div class="mb-4">
                    <h2 class="text-xl font-semibold mb-2">Audio URL</h2>
                    <input type="url" name="post[audio_url2]" value="{{ $post->audio_url2 }}" class="w-full p-2 border rounded">
                    @if ($errors->has('post.audio_url2'))
                        <p class="text-red-500">{{ $errors->first('post.audio_url2') }}</p>
                    @endif
                </div>
                <div class="text-center">
                    <input type="submit" value="update" class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer hover:bg-blue-700">
                </div>
            </form>
            <div class="footer mt-4">
                <a href="/posts/{{ $post->id }}" class="text-blue-500 hover:underline">戻る</a>
            </div>
        </div>
    </x-app-layout>
</body>
</html>
