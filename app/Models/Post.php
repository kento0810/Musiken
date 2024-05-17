<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'body1',
        'body2',
        'audio_url',
        'audio_url2',
        'category_id',
    ];
    
    public function getPaginateByLimit(int $limit_count =5)
    {
        return $this::with('categories')->orderby('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
     public function Categories()
    {
        return $this->belongsToMany(Category::class);
    }
    
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
    
    public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
    
}
