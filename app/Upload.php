<?php

// File.php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    use SoftDeletes;

	public function post()
    {
      return $this->belongsTo(Post::class);
    }

    public function user(){ 
        return $this->belongsTo(User::class);
    }




    

}