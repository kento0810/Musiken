<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Cloudinary;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts/index')->with(['posts' => $post->getPaginateByLimit()]);
    }
    
    public function show(Post $post)
    {
        return view ('/posts/show')->with(['post' => $post]);
    }
    
    public function store(PostRequest $request, Post $post) 
    {   
        $input = $request['post'];
        $audio_url = Cloudinary::uploadVideo($request->file('audio')->getRealPath())->getSecurePath();
        $input += ['audio_url' => $audio_url];
        $input_categories = $request->categories_array; 
        $post->fill($input)->save();
        $post->categories()->attach($input_categories); 
        return redirect('/posts/' . $post->id);
        
        $input_post = $request['post'];
        $input_categories = $request->categories_array;  //categories_arrayはnameで設定した配列名
        //先にpostsテーブルにデータを保存
        $post->fill($input_post)->save();
        //attachメソッドを使って中間テーブルにデータを保存
        $post->categories()->attach($input_categories); 
        return redirect('/posts');
    }
    
    public function edit(Post $post)
    {
        return view('posts/edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    public function create(Category $category)
    {
        return view('/posts/create')->with(['categories' => $category->get()]);
    }
}
