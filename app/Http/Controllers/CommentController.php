<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;



class CommentController extends Controller
{
    public function show(Comment $comment)
    {
        return view ('/posts/show')->with(['comment' => $comment]);
    }
    public function store(CommentRequest $request, Comment $comment)
    {
       
        
        $id = Auth::id();
        
        $input = [
            'body' => $request->input('comment.body'),
            'user_id' => $id,
            'post_id' => $request->input('comment.post_id'),
        ];
        
        $comment->fill($input)->save();
        return redirect()->back();
    }
    
    public function delete(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
