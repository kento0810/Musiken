<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'post.title' => 'required|string|max:50',
            'post.body1' => 'required|string|max:1000',
            'post.body2' => 'required|string|max:4000',
            'audio' => 'max:100000',
            
            
            
            
        ];
    }
}
 