<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts(){
    	// any tag may be applied to many posts
        return $this->belongsToMany(Post::class);
    }

    public function getRouteKeyName(){
    	return "name";
    }

    public function store(Post $post){
    	// Tag::create([
    	// 	'post_id' => request($post->id)
    	// 	'name' => request('name')
    	// ]);
    	// return redirect('/posts');
    }

    /*public function update(Tag $tag){
    	// $tag->update([
    	// 	'name' => request('name')
    	// ]);

    }*/
}