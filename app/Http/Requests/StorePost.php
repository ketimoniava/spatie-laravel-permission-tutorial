<?php

namespace App\Http\Requests;


use App\Post;

use App\Mail\PostCreated;

use illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;


class StorePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'title' => ['required', 'min:3', 'max:255'],

          'body'  => ['required', 'min:5'],

          'roles' => 'required',
        ];
    }


    /*public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'body.required'  => 'A message is required',
        ];
    }*/


    public function persist(){
       //dd(auth()->id());
        $createdPost = Post::create([
            'title' => $this->title,
            'body' => $this->body,
            'hasFile' => 0,
            'user_id' => auth()->id()
        ]);


        \Mail::to($createdPost->user->email)->send(new PostCreated($createdPost));

    }
}
