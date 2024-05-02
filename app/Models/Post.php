<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'body1',
        'body2',
        'audio_url',
        'audio_url2'
    ];
    
    public function getPaginateByLimit(int $limit_count =5)
    {
        return $this->orderby('updated_at', 'DESC')->paginate($limit_count);
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
}
