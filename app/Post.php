<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Post extends Model
{
    protected $guarded = []; 
    //for all fields
    //protected $fillable = ['title','body'];

    public function uploads()
    {       
      return $this->hasMany(Upload::class);
    }

    public function files()
    {       
      return $this->hasMany(File::class);
    }

    public function comments(){
    	return $this->hasMany(Comment::class);    	
    }

    public function user(){ //$post->user->name	$comment->post->user
    	return $this->belongsTo(User::class);
    }

    public function addFile($attributes){
        $this->files()->create($attributes);        
    }

    public function addComment($attributes){
        $attributes['user_id'] = auth()->id();
    	$this->comments()->create($attributes);
    }

    public function scopeFilter($query, $filters){       
       // print_r($filters);
       if($month = $filters['month']){
            //print_r($month);
            //echo $month;
            $query->whereMonth('created_at', Carbon::parse($month)->month);
        }

        if($year = $filters['year']){
            $query->whereYear('created_at', $year);
        }

        //$query->get();
    }

    public static function archives(){       
        
       return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
        ->groupBy('year','month')
        ->orderByRaw('min(created_at) desc')
        ->get()
        ->toArray();
    }

    public function tags(){
        // any post may have many tags
        // any tag may be applied to many posts
        return $this->belongsToMany(Tag::class);
    }
}
