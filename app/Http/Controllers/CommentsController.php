<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;

class CommentsController extends Controller
{
	public function store(Post $post){
		
		$attributes = $this->validate(request(), ['body'  => 'required|min:2']);
     	
     	/*Comment::create(request([
			'body' => request('body'),
			'post_id' => $post->id
		]);*/	
		//echo $post->id;
		//echo request('body');	
		//auth()->id();

		//dd($attributes);
		
		$post->addComment($attributes);
		return back();
	}

}
