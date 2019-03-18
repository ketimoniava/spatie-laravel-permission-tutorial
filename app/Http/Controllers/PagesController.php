<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PagesController extends Controller
{
    
    public function home(){
    	//$posts = $posts->all();
      if (request(['month', 'year'])) {
          $posts = Post::latest()->take(2)
           ->filter(request(['month', 'year']))
           ->with('tags')
           ->get();
      } else {
          $posts = Post::latest()->take(3)->get();
      }      

      return view('posts.index', compact('posts'));
    }
}
