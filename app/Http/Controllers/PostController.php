<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Cloudinary;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts/index')->with(['posts' => $post->getPaginateByLimit()]);
    }
    
    public function show(Post $post)
    {
        $user = auth()->user();
        $posts = Post::withCount('likes')->orderByDesc('updated_at')->get();
        return view ('/posts/show')->with(['post' => $post]);
        
    }
    
    public function store(PostRequest $request, Post $post) 
    {   
        $input = $request['post'];
        if($request->file('audio')){
        $audio_url = Cloudinary::uploadVideo($request->file('audio')->getRealPath())->getSecurePath();
        $input += ['audio_url' => $audio_url];
        }
        $input_categories = $request->categories_array; 
        $post->fill($input)->save();
        $post->categories()->attach($input_categories); 
        return redirect('/posts/' . $post->id);
        
        /*$input_post = $request['post'];
        $input_categories = $request->categories_array;  //categories_arrayはnameで設定した配列名
        //先にpostsテーブルにデータを保存
        $post->fill($input_post)->save();
        //attachメソッドを使って中間テーブルにデータを保存
        $post->categories()->attach($input_categories); 
        return redirect('/posts');*/
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
    
    
    public function like(Request $request)
    {
        
        $user_id = Auth::user()->id; // ログインしているユーザーのidを取得
        $post_id = $request->post_id; // 投稿のidを取得

        // すでにいいねがされているか判定するためにlikesテーブルから1件取得
        $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first(); 

        if (!$already_liked) { 
            $like = new Like; // Likeクラスのインスタンスを作成
            $like->post_id = $post_id;
            $like->user_id = $user_id;
            $like->save();
        } else {
            // 既にいいねしてたらdelete 
            Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
        }
        // 投稿のいいね数を取得
        $post_likes_count = Post::withCount('likes')->findOrFail($post_id)->likes_count;
        $param = [
            'post_likes_count' => $post_likes_count,
        ];
        return response()->json($param); // JSONデータをjQueryに返す
       
    }
    /*public function like(Request $request) {
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first();

        if ($already_liked) {
            // いいねを取り消す
            $already_liked->delete();
            $liked = false;
        } else {
            // いいねを作成
            Like::create([
                'user_id' => $user_id,
                'post_id' => $post_id,
            ]);
            $liked = true;
        }

        $post_likes_count = Post::withCount('likes')->findOrFail($post_id)->likes_count;

        return response()->json([
            'liked' => $liked,
            'likes_count' => $post_likes_count,
        ]);
    }*/
}
