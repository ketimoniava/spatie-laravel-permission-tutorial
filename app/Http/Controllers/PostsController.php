<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Repositories\Posts;
use Carbon\Carbon;
//use App\Mail\PostCreated;
use App\Http\Requests\StorePost;
use Intervention\Image\ImageManagerStatic as Image;
//use Image;
use File;

use Validator;

class PostsController extends Controller
{
    public function __construct(){
      //W$this->middleware('auth');
      $this->middleware('can:update,post')->except(['index','show', 'posts','create', 'store','logout']);

      //$this->middleware('auth')->except(['index','show', 'posts']);
    }

    public function index(Request $request){  
      $user = $request->user();
      if($user){
        //$request->user()->authorizeRoles(['employee', 'manager']);
      }
      
      /*if($request->user()->hasRole('manager')){
        return redirect('/login');
      }*/

      if (request(['month', 'year'])) {
        $posts = Post::latest()->take(2)
          ->filter(request(['month', 'year']))
          ->with('tags')
          ->get();
      } else {
        $posts = Post::latest()->get();
      } 

      //$fileinfo = Post::find(1)->files()->latest()->take(1)->get(); 
      //$fileinfo = Post::find(1)->files;
    
      return view('posts.index', compact('posts'));
    }

    public function show(Post $post){ 
      //$this->authorize('update', $post);
      //abort_if(\Gate::denies('update', $post), 403);
      return view('posts.show', compact('post'));
    }

    public function create(){ //create page
      
      return view('posts.create');
    }

    public function store(storePost $storePost){ //submit add post form
      
      //migrate fresh
      //vue
      //php artisan preset none
      //react js
      //git master nah 
      //php artisan preset react
      //php artisan preset bootstrap
      // Laravel 5.5 version code
      // $posts = request()->validate([
      //   'title'=>'required',
      //   'body'=> 'required'
      // ]);

      //Post::create($attributes);   	
     	
      session()->flash(
          'message', 'Your post has now been published.'
      );

      // flash('Your message is here');


      $storePost = $storePost->persist();

      return redirect('/');
        //POST /tasks
    }

    public function upload(){ //sacdeli varianti

   }

    public function edit(Post $post){

      return view('posts.edit', compact('post'));

    }
    
    public function update(Post $post){

      $attributes = request()->validate([
          'title' => ['required', 'min:3', 'max:255'],

          'body'  => ['required', 'min:5']
      ]);

      $post->update($attributes);      
      $url = '/posts/'.$post->id.'/create/files';
      return redirect($url);
    }

    public function destroy(Post $post){
      $post->delete();
      return redirect('/posts');
    }

    public function posts(){ //full history      
      
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
