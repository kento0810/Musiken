<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    
    public function create()
    {
        return view('/posts/create');
    }
    
    public function store(Request $request, Post $post)
    {   
        $input = $request['post'];
        $audio_url = Cloudinary::uploadVideo($request->file('audio')->getRealPath())->getSecurePath();
        $input += ['audio_url' => $audio_url];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
}
