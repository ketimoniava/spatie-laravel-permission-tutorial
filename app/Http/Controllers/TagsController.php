<?php

namespace App\Http\Controllers;

use App\Tag;

use Illuminate\Http\Request;

//use App\Post;

class TagsController extends Controller
{   
   public function index(Tag $tag) {    	
   		$posts = $tag->posts->load('tags');
   		//$posts = $tag->posts()->latest()->paginate(5);
   		//return $posts;
   		return view('posts.index', compact('posts'));

	}
}
