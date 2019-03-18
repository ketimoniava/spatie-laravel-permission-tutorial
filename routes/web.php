<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*app()->singleton('App\Services\Twitter', function(){
	return new \App\Services\Twitter('dfsfsdsdfsdf');

});*/

/*app()->bind('post', function(){
	return new \App\Post;

});*/

/*Route::get('/', function (UserRepository $users) {
	dd($users);
    //return 'uu';
});*/

// Route::get('/', function () {
//     return view('welcome');
// });

//->middleware('can:update,post');


/*GET  /posts (index)
GET /posts/create (create)
GET /posts/1 (show)
POST /posts (store)
GET /posts/1/edit (edit)
PATCH /posts/1 (update)
DELETE /posts/1 (destroy)*/
//middleware('can:update,post);

//https://code.tutsplus.com/tutorials/how-to-register-use-laravel-service-providers--cms-28966

//->name('home')

Route::get('/','PostsController@index')->name('posts');

Route::resource('posts','PostsController');//->middleware('can:update,post');//->except(['index', 'create', 'store']);
//->only(['show', 'edit', 'update', 'destroy']);

//Route::get('/','PagesController@home');


/*
full routes
Route::get('/posts','PostsController@posts');
Route::get('/posts/create','PostsController@create');
Route::post('/posts','PostsController@store'); 
Route::get('/posts/{post}','PostsController@show'); 
Route::get('/posts/{post}/edit','PostsController@edit'); 
Route::patch('/posts/{post}','PostsController@update');
Route::delete('/posts/{post}','PostsController@destroy');*/



Route::get('/posts/tags/{tag}','TagsController@index');

Route::post('/posts/{post}/comments','CommentsController@store');


Route::get('/register','RegistrationController@create');

Route::post('/register','RegistrationController@store');

Route::get('/login','SessionsController@create');

Route::post('/login','SessionsController@store');

Route::get('/logout','SessionsController@destroy');


Route::get('posts/{post}/files', 'FileController@index');
Route::get('posts/{post}/create/files', 'FileController@create');
Route::post('posts/{post}/files', 'FileController@store');
//Route::post('post/edit/{id}', 'FileController@edit');
Route::post('posts/delete/{fileid}/files', 'FileController@destroy');




Route::get('/', function(\Illuminate\Http\Request $request) {
      
      $user = $request->user();

      //dd($user->can('edit post'));

      if(auth()){

      	//echo "text";
      }

      $user->hasPermissionTo('edit post');

      //return new Response(null, 200);
});




Route::group(['middleware' => 'role:admin'], function() {
   /*Route::get('/admin', function() {
      return 'Welcome Admin';
   });*/

   Route::resource('posts','PostsController');
});



//MANAGER ROUTES
Route::group(['middleware' => ['role:editor']], function () {
	
	

});


//WRITER ROUTES
Route::group(['middleware' => ['role:writer']], function () {
	
	

});


